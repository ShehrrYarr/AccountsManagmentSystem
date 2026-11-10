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
 * A department or supplier balance carried over from before the system, for one company.
 * Cash and bank opening balances live on the account itself.
 *
 *   Department: amount > 0 → it owes me; amount < 0 → I hold its money.
 *   Supplier:   amount > 0 → I owe it.
 */
class OpeningBalance extends Model implements PostsToLedger
{
    use Auditable, HasTransactions, SoftDeletes;

    protected $fillable = ['company_id', 'department_id', 'supplier_id', 'amount', 'date', 'notes', 'created_by'];

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

    public function partyName(): string
    {
        return $this->department?->name ?? $this->supplier?->name ?? '?';
    }

    public function ledgerPostings(): array
    {
        $abs = Money::isNegative($this->amount) ? Money::sub(0, $this->amount) : Money::of($this->amount);
        $equity = ['account' => LedgerAccount::OpeningEquity, 'company_id' => $this->company_id];

        if ($this->department_id) {
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
                'amount' => $abs,
                'description' => "Opening balance — {$this->partyName()}",
                'notes' => $this->notes,
            ],
            'allowEmpty' => true,
        ]];
    }
}
