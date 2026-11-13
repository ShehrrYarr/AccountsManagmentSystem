<?php

namespace App\Services;

use App\Exceptions\BusinessRuleException;
use App\Models\Payment;
use App\Models\PaymentChangeRequest;
use App\Models\User;
use App\Support\Money;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Agents save their department payments straight away, but can't change a saved one themselves:
 * an edit or delete becomes a request that the admin approves (then it is applied through
 * PaymentService) or rejects. One open request per payment.
 */
class PaymentApprovalService
{
    public function __construct(private PaymentService $payments) {}

    /** Ask to change a payment. $data holds the form values; only real differences are kept. */
    public function requestEdit(Payment $payment, array $data, User $agent, ?string $reason = null): PaymentChangeRequest
    {
        $this->assertMayRequest($payment, $agent);

        // Same checks a save would run, without saving.
        $this->payments->checkPayment($data + ['method' => $payment->method->value], $payment, $agent);

        $changes = [];
        foreach (array_keys(PaymentChangeRequest::FIELDS) as $field) {
            if (! array_key_exists($field, $data) || ($field === 'receipt_path' && blank($data[$field]))) {
                continue;
            }
            $new = $this->normalise($field, $data[$field]);
            if ($new !== $this->normalise($field, $payment->getRawOriginal($field))) {
                $changes[$field] = $new;
            }
        }

        if ($changes === []) {
            throw new BusinessRuleException('Nothing was changed.');
        }

        return PaymentChangeRequest::create([
            'payment_id' => $payment->id, 'requested_by' => $agent->id, 'action' => 'edit',
            'changes' => $changes, 'reason' => $reason, 'status' => PaymentChangeRequest::PENDING,
        ]);
    }

    public function requestDelete(Payment $payment, User $agent, ?string $reason = null): PaymentChangeRequest
    {
        $this->assertMayRequest($payment, $agent);

        return PaymentChangeRequest::create([
            'payment_id' => $payment->id, 'requested_by' => $agent->id, 'action' => 'delete',
            'reason' => $reason, 'status' => PaymentChangeRequest::PENDING,
        ]);
    }

    /** Apply the request. If the change no longer passes the rules, it stays pending with the reason. */
    public function approve(PaymentChangeRequest $request, User $admin, ?string $note = null): void
    {
        $this->assertDecidable($request, $admin);

        DB::transaction(function () use ($request, $admin, $note) {
            $payment = $request->payment;
            if (! $payment || $payment->trashed()) {
                throw new BusinessRuleException('This payment no longer exists.');
            }

            if ($request->isDelete()) {
                $this->payments->delete($payment);
            } else {
                $old = $payment->receipt_path;
                $this->payments->savePayment($payment, $request->changes, $admin);
                if (isset($request->changes['receipt_path']) && $old && $old !== $request->changes['receipt_path']) {
                    DB::afterCommit(fn () => Storage::disk('local')->delete($old));
                }
            }

            $request->update(['status' => PaymentChangeRequest::APPROVED, 'decided_by' => $admin->id, 'decided_at' => now(), 'decision_note' => $note]);
        });
    }

    public function reject(PaymentChangeRequest $request, User $admin, ?string $note = null): void
    {
        $this->assertDecidable($request, $admin);

        $newReceipt = $request->changes['receipt_path'] ?? null;
        $request->update(['status' => PaymentChangeRequest::REJECTED, 'decided_by' => $admin->id, 'decided_at' => now(), 'decision_note' => $note]);

        if ($newReceipt && $newReceipt !== $request->payment?->receipt_path) {
            Storage::disk('local')->delete($newReceipt); // the uploaded replacement isn't needed
        }
    }

    /** The agent withdraws their own pending request. */
    public function cancel(PaymentChangeRequest $request, User $agent): void
    {
        if (! $request->isPending() || $request->requested_by !== $agent->id) {
            throw new BusinessRuleException('Only your own pending request can be withdrawn.');
        }
        if ($receipt = $request->changes['receipt_path'] ?? null) {
            Storage::disk('local')->delete($receipt);
        }
        $request->delete();
    }

    private function assertMayRequest(Payment $payment, User $agent): void
    {
        if ($payment->created_by !== $agent->id) {
            throw new BusinessRuleException('You can only ask to change payments you made.');
        }
        if ($payment->pendingRequest()->exists()) {
            throw new BusinessRuleException('A change to this payment is already waiting for the admin.');
        }
    }

    private function assertDecidable(PaymentChangeRequest $request, User $admin): void
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
            'amount' => Money::of($value),
            'company_id', 'account_id', 'department_id' => $value === null || $value === '' ? null : (int) $value,
            'date' => $value ? substr((string) $value, 0, 10) : null,
            default => filled($value) ? trim((string) $value) : null,
        };
    }
}
