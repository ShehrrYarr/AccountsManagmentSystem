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
 * Closing a deal brings a department's balance (for one company) back to zero.
 *
 *   Cheques exceeded spending (profit) : Dr Department / Cr Profit on deals
 *   Spending exceeded cheques (loss)   : Dr Loss on deals / Cr Department
 */
class DealClosing extends Model implements PostsToLedger
{
    use Auditable, HasTransactions, SoftDeletes;

    protected $fillable = ['company_id', 'department_id', 'date', 'amount', 'notes', 'created_by'];

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

    public function isProfit(): bool
    {
        return ! Money::isNegative($this->amount);
    }

    public function ledgerPostings(): array
    {
        $abs = Money::isNegative($this->amount) ? Money::sub(0, $this->amount) : Money::of($this->amount);
        $dept = ['account' => LedgerAccount::Department, 'company_id' => $this->company_id, 'department_id' => $this->department_id];
        $result = ['account' => LedgerAccount::DealResult, 'company_id' => $this->company_id, 'department_id' => $this->department_id];

        $lines = $this->isProfit()
            ? [$dept + ['debit' => $abs], $result + ['credit' => $abs]]
            : [$result + ['debit' => $abs], $dept + ['credit' => $abs]];

        return [[
            'type' => TransactionType::DealClosing,
            'date' => $this->date,
            'lines' => $lines,
            'attributes' => [
                'company_id' => $this->company_id,
                'department_id' => $this->department_id,
                'amount' => $abs,
                'description' => "Deal closed with {$this->department?->name} — ".($this->isProfit() ? 'profit ' : 'loss ').money($abs),
                'notes' => $this->notes,
            ],
        ]];
    }
}
