<?php

namespace App\Models;

use App\Enums\LedgerAccount;
use App\Enums\PaymentMethod;
use App\Enums\TransactionType;
use App\Models\Concerns\Auditable;
use App\Models\Concerns\HasTransactions;
use App\Models\Contracts\PostsToLedger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Money spent for a department: cash handed over, a bank transfer, or goods bought from a supplier.
 *
 *   Cash / transfer   : Dr Department / Cr Cash or Bank
 *   Goods, paid now   : Dr Department / Cr Supplier,  Dr Supplier / Cr Cash or Bank   (supplier ledger shows both)
 *   Goods, on credit  : Dr Department / Cr Supplier
 */
class Payment extends Model implements PostsToLedger
{
    use Auditable, HasTransactions, SoftDeletes;

    protected $fillable = [
        'company_id', 'department_id', 'method', 'account_id', 'supplier_id', 'on_credit', 'amount', 'date',
        'reference', 'received_by', 'item_description', 'receipt_path', 'notes', 'created_by',
    ];

    protected function casts(): array
    {
        return [
            'method' => PaymentMethod::class,
            'on_credit' => 'boolean',
            'amount' => 'decimal:2',
            'date' => 'date',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class)->withTrashed();
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /** One line a person can read in any ledger, e.g. "Bank transfer to Health Dept from HBL — ref IBFT-55". */
    public function describe(): string
    {
        $dept = $this->department?->name ?? 'department';
        $ref = $this->reference ? " — ref {$this->reference}" : '';

        return match ($this->method) {
            PaymentMethod::Cash => "Cash given to {$dept}".($this->received_by ? " (received by {$this->received_by})" : '').$ref,
            PaymentMethod::BankTransfer => "Bank transfer to {$dept} from {$this->account?->shortLabel()}{$ref}",
            PaymentMethod::Goods => "Goods for {$dept} from {$this->supplier?->name}"
                .($this->item_description ? ': '.Str::limit($this->item_description, 80) : '')
                .($this->on_credit ? ' (on credit)' : " (paid from {$this->account?->shortLabel()})").$ref,
        };
    }

    public function ledgerPostings(): array
    {
        $dept = ['account' => LedgerAccount::Department, 'debit' => $this->amount, 'company_id' => $this->company_id, 'department_id' => $this->department_id];
        $money = ['account' => LedgerAccount::Money, 'credit' => $this->amount, 'company_id' => $this->company_id, 'account_id' => $this->account_id];

        if ($this->method === PaymentMethod::Goods) {
            $lines = [$dept, ['account' => LedgerAccount::Supplier, 'credit' => $this->amount, 'company_id' => $this->company_id, 'supplier_id' => $this->supplier_id]];
            if (! $this->on_credit) {
                $lines[] = ['account' => LedgerAccount::Supplier, 'debit' => $this->amount, 'company_id' => $this->company_id, 'supplier_id' => $this->supplier_id];
                $lines[] = $money;
            }
            $type = TransactionType::GoodsPurchase;
        } else {
            $lines = [$dept, $money];
            $type = TransactionType::DepartmentPayment;
        }

        return [[
            'type' => $type,
            'date' => $this->date,
            'lines' => $lines,
            'attributes' => [
                'company_id' => $this->company_id,
                'department_id' => $this->department_id,
                'supplier_id' => $this->supplier_id,
                'account_id' => $this->on_credit ? null : $this->account_id,
                'amount' => $this->amount,
                'reference' => $this->reference,
                'description' => $this->describe(),
                'notes' => $this->notes,
            ],
        ]];
    }
}
