<?php

namespace App\Models;

use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Models\Concerns\Auditable;
use App\Models\Concerns\HasTransactions;
use App\Models\Contracts\PostsToLedger;
use App\Support\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * A balance carried over from before the system, for one company:
 *
 *   Department: amount > 0 → it owes me; amount < 0 → I hold its money.
 *   Supplier:   amount > 0 → I owe it.
 *   Cash:       account_id = the admin's cash in hand; amount > 0 is the cash held for this company.
 *   Agent:      account_id = an agent's account; amount > 0 is this company's money the agent
 *               already held (and owes back) on the start date.
 *
 * Bank opening balances live on the bank account itself.
 */
class OpeningBalance extends Model implements PostsToLedger
{
    use Auditable, HasTransactions, SoftDeletes;

    protected $fillable = ['company_id', 'department_id', 'supplier_id', 'account_id', 'amount', 'date', 'notes', 'created_by'];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2', 'date' => 'date'];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class)->withTrashed();
    }

    public function isCash(): bool
    {
        return (bool) $this->account_id;
    }

    public function isAgent(): bool
    {
        return (bool) $this->account?->isAgentAccount();
    }

    public function partyName(): string
    {
        return $this->department?->name ?? $this->supplier?->name ?? match (true) {
            $this->isAgent() => $this->account->holderName().' · '.$this->account->shortLabel(),
            (bool) $this->account_id => 'Cash in hand',
            default => '?',
        };
    }

    public function ledgerPostings(): array
    {
        $abs = Money::isNegative($this->amount) ? Money::sub(0, $this->amount) : Money::of($this->amount);
        $equity = ['account' => LedgerAccount::OpeningEquity, 'company_id' => $this->company_id];

        if ($this->account_id) {
            $party = ['account' => $this->isAgent() ? LedgerAccount::Agent : LedgerAccount::Money, 'company_id' => $this->company_id, 'account_id' => $this->account_id];
            $owesMe = true; // cash held (by the admin or an agent): Dr cash / Cr opening equity
        } elseif ($this->department_id) {
            $party = ['account' => LedgerAccount::Department, 'company_id' => $this->company_id, 'department_id' => $this->department_id];
            $owesMe = ! Money::isNegative($this->amount);
        } else {
            $party = ['account' => LedgerAccount::Supplier, 'company_id' => $this->company_id, 'supplier_id' => $this->supplier_id];
            $owesMe = false; // supplier opening is always what I owe
        }

        $lines = $owesMe
            ? [$party + ['debit' => $abs], $equity + ['credit' => $abs]]
            : [$equity + ['debit' => $abs], $party + ['credit' => $abs]];

        return [[
            'type' => TransactionType::OpeningBalance,
            'date' => $this->date,
            'lines' => $lines,
            'attributes' => [
                'company_id' => $this->company_id,
                'department_id' => $this->department_id,
                'supplier_id' => $this->supplier_id,
                'to_account_id' => $this->account_id,
                'amount' => $abs,
                'description' => "Opening balance — {$this->partyName()}",
                'notes' => $this->notes,
            ],
            'allowEmpty' => true,
        ]];
    }
}
