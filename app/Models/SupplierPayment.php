<?php

namespace App\Models;

use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Models\Concerns\Auditable;
use App\Models\Concerns\HasTransactions;
use App\Models\Contracts\PostsToLedger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Paying a supplier what a company owes it:  Dr Supplier / Cr Cash or Bank.
 */
class SupplierPayment extends Model implements PostsToLedger
{
    use Auditable, HasTransactions, SoftDeletes;

    protected $fillable = ['company_id', 'supplier_id', 'account_id', 'amount', 'date', 'reference', 'notes', 'created_by'];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2', 'date' => 'date'];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class)->withTrashed();
    }

    public function ledgerPostings(): array
    {
        return [[
            'type' => TransactionType::SupplierPayment,
            'date' => $this->date,
            'lines' => [
                ['account' => LedgerAccount::Supplier, 'debit' => $this->amount, 'company_id' => $this->company_id, 'supplier_id' => $this->supplier_id],
                ['account' => LedgerAccount::Money, 'credit' => $this->amount, 'company_id' => $this->company_id, 'account_id' => $this->account_id],
            ],
            'attributes' => [
                'company_id' => $this->company_id,
                'supplier_id' => $this->supplier_id,
                'account_id' => $this->account_id,
                'amount' => $this->amount,
                'reference' => $this->reference,
                'description' => "Paid {$this->supplier?->name} from {$this->account?->shortLabel()}".($this->reference ? " — ref {$this->reference}" : ''),
                'notes' => $this->notes,
            ],
        ]];
    }
}
