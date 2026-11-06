<?php

namespace App\Services;

use App\Enums\ApprovalAction;
use App\Enums\ApprovalStatus;
use App\Exceptions\BusinessRuleException;
use App\Models\ApprovalRequest;
use App\Models\Cheque;
use App\Models\Disbursement;
use App\Models\InternalTransfer;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Queue of staff actions waiting for an administrator.
 *
 * On approval the stored payload is replayed through the owning service,
 * so all business rules (balances, statuses) are re-checked at that moment.
 */
class ApprovalService
{
    public function request(ApprovalAction $action, Model $subject, array $payload, User $by, string $summary): ApprovalRequest
    {
        $exists = ApprovalRequest::pending()
            ->where('subject_type', $subject->getMorphClass())
            ->where('subject_id', $subject->getKey())
            ->exists();

        if ($exists) {
            throw new BusinessRuleException('There is already a pending approval request for this record. Wait for an administrator to review it.');
        }

        return ApprovalRequest::create([
            'action' => $action,
            'subject_type' => $subject->getMorphClass(),
            'subject_id' => $subject->getKey(),
            'payload' => $payload,
            'summary' => mb_substr($summary, 0, 255),
            'status' => ApprovalStatus::Pending,
            'requested_by' => $by->id,
        ]);
    }

    public function approve(ApprovalRequest $request, User $admin, ?string $notes = null): void
    {
        $this->assertReviewable($request, $admin);

        DB::transaction(function () use ($request, $admin, $notes) {
            $subject = $request->subject;
            $payload = $request->payload ?? [];
            $requester = $request->requester;

            if (! $subject || (method_exists($subject, 'trashed') && $subject->trashed())) {
                throw new BusinessRuleException('The record for this request no longer exists. Reject it instead.');
            }

            match (true) {
                $request->action === ApprovalAction::ClearCheque => app(ChequeService::class)->performClear($subject, $payload, $requester),
                $request->action === ApprovalAction::BounceCheque => app(ChequeService::class)->performBounce($subject, $payload),
                $request->action === ApprovalAction::CancelCheque => app(ChequeService::class)->performCancel($subject, $payload),
                $request->action === ApprovalAction::PostDisbursement => app(DisbursementService::class)->approve($subject, $admin),
                $request->action === ApprovalAction::UpdateRecord => $this->performUpdate($subject, $payload),
                $request->action === ApprovalAction::DeleteRecord => $this->performDelete($subject),
            };

            $request->update([
                'status' => ApprovalStatus::Approved,
                'reviewed_by' => $admin->id,
                'reviewed_at' => now(),
                'review_notes' => $notes,
            ]);
        });
    }

    public function reject(ApprovalRequest $request, User $admin, ?string $notes = null): void
    {
        $this->assertReviewable($request, $admin);

        DB::transaction(function () use ($request, $admin, $notes) {
            if ($request->action === ApprovalAction::PostDisbursement && $request->subject instanceof Disbursement) {
                app(DisbursementService::class)->reject($request->subject);
            }

            $request->update([
                'status' => ApprovalStatus::Rejected,
                'reviewed_by' => $admin->id,
                'reviewed_at' => now(),
                'review_notes' => $notes,
            ]);
        });
    }

    /** Auto-close pending requests when their record is deleted. */
    public function closePendingFor(Model $subject, string $notes): void
    {
        ApprovalRequest::pending()
            ->where('subject_type', $subject->getMorphClass())
            ->where('subject_id', $subject->getKey())
            ->update([
                'status' => ApprovalStatus::Rejected,
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
                'review_notes' => $notes,
            ]);
    }

    private function performUpdate(Model $subject, array $payload): void
    {
        match (true) {
            $subject instanceof Cheque => app(ChequeService::class)->performUpdate($subject, $payload),
            $subject instanceof Disbursement => app(DisbursementService::class)->performUpdate($subject, $payload),
            $subject instanceof InternalTransfer => app(InternalTransferService::class)->performUpdate($subject, $payload),
        };
    }

    private function performDelete(Model $subject): void
    {
        match (true) {
            $subject instanceof Cheque => app(ChequeService::class)->performDelete($subject),
            $subject instanceof Disbursement => app(DisbursementService::class)->performDelete($subject),
            $subject instanceof InternalTransfer => app(InternalTransferService::class)->performDelete($subject),
        };
    }

    private function assertReviewable(ApprovalRequest $request, User $admin): void
    {
        if (! $admin->isAdmin()) {
            throw new BusinessRuleException('Only administrators can review approval requests.');
        }
        if ($request->status !== ApprovalStatus::Pending) {
            throw new BusinessRuleException('This request has already been reviewed.');
        }
    }
}
