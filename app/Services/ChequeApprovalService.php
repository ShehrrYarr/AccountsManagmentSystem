<?php

namespace App\Services;

use App\Exceptions\BusinessRuleException;
use App\Models\Cheque;
use App\Models\ChequeChangeRequest;
use App\Models\User;
use App\Support\Money;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Agents can't change a saved cheque themselves: an edit or delete becomes a request that the
 * admin approves (then it is applied through ChequeService) or rejects. One open request per cheque.
 */
class ChequeApprovalService
{
    public function __construct(private ChequeService $cheques) {}

    /** Ask to change a cheque. $data holds the form values; only real differences are kept. */
    public function requestEdit(Cheque $cheque, array $data, User $agent, ?string $reason = null): ChequeChangeRequest
    {
        $this->assertMayRequest($cheque, $agent);

        // Same checks a save would run, without saving.
        $this->cheques->check($data, $cheque);

        $changes = [];
        foreach (array_keys(ChequeChangeRequest::FIELDS) as $field) {
            if (! array_key_exists($field, $data) || ($field === 'scan_path' && blank($data[$field]))) {
                continue;
            }
            $new = $this->normalise($field, $data[$field]);
            if ($new !== $this->normalise($field, $cheque->getRawOriginal($field))) {
                $changes[$field] = $new;
            }
        }

        if ($changes === []) {
            throw new BusinessRuleException('Nothing was changed.');
        }

        return ChequeChangeRequest::create([
            'cheque_id' => $cheque->id, 'requested_by' => $agent->id, 'action' => 'edit',
            'changes' => $changes, 'reason' => $reason, 'status' => ChequeChangeRequest::PENDING,
        ]);
    }

    public function requestDelete(Cheque $cheque, User $agent, ?string $reason = null): ChequeChangeRequest
    {
        $this->assertMayRequest($cheque, $agent);

        return ChequeChangeRequest::create([
            'cheque_id' => $cheque->id, 'requested_by' => $agent->id, 'action' => 'delete',
            'reason' => $reason, 'status' => ChequeChangeRequest::PENDING,
        ]);
    }

    /** Apply the request. If the change no longer passes the rules, it stays pending with the reason. */
    public function approve(ChequeChangeRequest $request, User $admin, ?string $note = null): void
    {
        $this->assertDecidable($request, $admin);

        DB::transaction(function () use ($request, $admin, $note) {
            $cheque = $request->cheque;
            if (! $cheque || $cheque->trashed()) {
                throw new BusinessRuleException('This cheque no longer exists.');
            }

            if ($request->isDelete()) {
                $this->cheques->delete($cheque);
            } else {
                $old = $cheque->scan_path;
                $this->cheques->save($cheque, $request->changes, $admin);
                if (isset($request->changes['scan_path']) && $old && $old !== $request->changes['scan_path']) {
                    DB::afterCommit(fn () => Storage::disk('local')->delete($old));
                }
            }

            $request->update(['status' => ChequeChangeRequest::APPROVED, 'decided_by' => $admin->id, 'decided_at' => now(), 'decision_note' => $note]);
        });
    }

    public function reject(ChequeChangeRequest $request, User $admin, ?string $note = null): void
    {
        $this->assertDecidable($request, $admin);

        $newScan = $request->changes['scan_path'] ?? null;
        $request->update(['status' => ChequeChangeRequest::REJECTED, 'decided_by' => $admin->id, 'decided_at' => now(), 'decision_note' => $note]);

        if ($newScan && $newScan !== $request->cheque?->scan_path) {
            Storage::disk('local')->delete($newScan); // the uploaded replacement isn't needed
        }
    }

    /** The agent withdraws their own pending request. */
    public function cancel(ChequeChangeRequest $request, User $agent): void
    {
        if (! $request->isPending() || $request->requested_by !== $agent->id) {
            throw new BusinessRuleException('Only your own pending request can be withdrawn.');
        }
        if ($scan = $request->changes['scan_path'] ?? null) {
            Storage::disk('local')->delete($scan);
        }
        $request->delete();
    }

    private function assertMayRequest(Cheque $cheque, User $agent): void
    {
        if ($cheque->created_by !== $agent->id) {
            throw new BusinessRuleException('You can only ask to change cheques you received.');
        }
        if ($cheque->pendingRequest()->exists()) {
            throw new BusinessRuleException('A change to this cheque is already waiting for the admin.');
        }
    }

    private function assertDecidable(ChequeChangeRequest $request, User $admin): void
    {
        if (! $admin->isAdmin()) {
            throw new BusinessRuleException('Only the admin can approve or reject changes.');
        }
        if (! $request->isPending()) {
            throw new BusinessRuleException('This request was already '.$request->status.'.');
        }
    }

    private function normalise(string $field, mixed $value): mixed
    {
        return match ($field) {
            'amount', 'bank_charges' => Money::of($value),
            'company_id', 'deposit_account_id', 'department_id' => $value === null || $value === '' ? null : (int) $value,
            'cheque_date' => $value ? substr((string) $value, 0, 10) : null,
            default => filled($value) ? trim((string) $value) : null,
        };
    }
}
