<?php

namespace App\Models;

use App\Enums\AccountType;
use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Models\Concerns\Auditable;
use App\Models\Concerns\HasTransactions;
use App\Models\Contracts\PostsToLedger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Money moved between two accounts.
 *
 * Each side names its company (from_company_id / to_company_id): a bank says it itself, and the
 * admin's cash in hand is shared, so the form asks which company the cash side is for.
 *
 *   Same company       : Dr To account / Cr From account     (ATM withdrawal, cash deposit, bank to bank)
 *   Between companies  : A: Dr Inter-company(B) / Cr From account
 *                        B: Dr To account       / Cr Inter-company(A)
 *                        so B owes A until the money is sent back.
 */
class Transfer extends Model implements PostsToLedger
{
    use Auditable, HasTransactions, SoftDeletes;

    protected $fillable = ['from_company_id', 'from_account_id', 'to_company_id', 'to_account_id', 'amount', 'date', 'reference', 'notes', 'created_by'];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2', 'date' => 'date'];
    }

    public function fromAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'from_account_id')->withTrashed();
    }

    public function toAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'to_account_id')->withTrashed();
    }

    public function fromCompany(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'from_company_id')->withTrashed();
    }

    public function toCompany(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'to_company_id')->withTrashed();
    }

    public function isInterCompany(): bool
    {
        return (int) $this->from_company_id !== (int) $this->to_company_id;
    }

    /** Plain-language kind of move, e.g. "Cash withdrawal". */
    public function kind(): string
    {
        $from = $this->fromAccount->type;
        $to = $this->toAccount->type;

        return match (true) {
            $this->isInterCompany() => 'Inter-company transfer',
            $from === AccountType::Bank && $to === AccountType::Cash => 'Cash withdrawal',
            $from === AccountType::Cash && $to === AccountType::Bank => 'Cash deposit',
            default => 'Bank to bank transfer',
        };
    }

    public function describe(): string
    {
        $from = $this->fromAccount;
        $to = $this->toAccount;
        $ref = $this->reference ? " — ref {$this->reference}" : '';

        return $this->isInterCompany()
            ? "Transfer from {$this->fromCompany?->name} ({$from->shortLabel()}) to {$this->toCompany?->name} ({$to->shortLabel()}){$ref}"
            : "{$this->kind()}: {$from->shortLabel()} → {$to->shortLabel()}{$ref}";
    }

    public function ledgerPostings(): array
    {
        $from = $this->fromAccount;
        $to = $this->toAccount;

        $lines = [
            ['account' => LedgerAccount::Money, 'debit' => $this->amount, 'company_id' => $this->to_company_id, 'account_id' => $to->id],
            ['account' => LedgerAccount::Money, 'credit' => $this->amount, 'company_id' => $this->from_company_id, 'account_id' => $from->id],
        ];

        if ($this->isInterCompany()) {
            $lines[] = ['account' => LedgerAccount::InterCompany, 'debit' => $this->amount, 'company_id' => $this->from_company_id, 'counterparty_company_id' => $this->to_company_id];
            $lines[] = ['account' => LedgerAccount::InterCompany, 'credit' => $this->amount, 'company_id' => $this->to_company_id, 'counterparty_company_id' => $this->from_company_id];
        }

        return [[
            'type' => $this->isInterCompany() ? TransactionType::InterCompanyTransfer : TransactionType::AccountTransfer,
            'date' => $this->date,
            'lines' => $lines,
            'attributes' => [
                'company_id' => $this->from_company_id,
                'counterparty_company_id' => $this->isInterCompany() ? $this->to_company_id : null,
                'account_id' => $from->id,
                'to_account_id' => $to->id,
                'amount' => $this->amount,
                'reference' => $this->reference,
                'description' => $this->describe(),
                'notes' => $this->notes,
            ],
        ]];
    }
}
