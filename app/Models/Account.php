<?php

namespace App\Models;

use App\Enums\AccountType;
use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Models\Concerns\Auditable;
use App\Models\Concerns\HasTransactions;
use App\Models\Contracts\PostsToLedger;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * A money account. Who holds it:
 *
 *   company_id set           a company's bank account (companies have no cash of their own)
 *   neither set, type cash   the ADMIN's single cash in hand, shared by every company: each journal
 *                            line on it still names the company it was for (Account::adminCash())
 *   agent_id set             an agent's cash in hand or bank account (stored, not used yet)
 *
 * The only ledger posting an account owns is a company bank's opening balance. Cash openings
 * are OpeningBalance rows (per company) on the admin's cash.
 */
class Account extends Model implements PostsToLedger
{
    use Auditable, HasTransactions, HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id', 'agent_id', 'type', 'name', 'bank_name', 'branch', 'account_title', 'account_number', 'iban',
        'opening_balance', 'opening_date', 'is_active', 'created_by',
    ];

    protected array $auditExclude = ['current_balance'];

    protected function casts(): array
    {
        return [
            'type' => AccountType::class,
            'opening_balance' => 'decimal:2',
            'opening_date' => 'date',
            'current_balance' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    /** The admin's cash in hand (created by the 2026_11_14 migration; recreated if ever missing). */
    public static function adminCash(): self
    {
        return static::query()->adminCashOnly()->first()
            ?? static::create(['type' => AccountType::Cash, 'name' => 'Cash in hand', 'is_active' => true]);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function ledgerEntries(): HasMany
    {
        return $this->hasMany(JournalLedgerEntry::class);
    }

    public function isCash(): bool
    {
        return $this->type === AccountType::Cash;
    }

    public function isAdminCash(): bool
    {
        return $this->isCash() && ! $this->company_id && ! $this->agent_id;
    }

    public function isAgentAccount(): bool
    {
        return (bool) $this->agent_id;
    }

    /** Added for an agent by someone other than that agent (i.e. the admin). */
    public function addedByAdmin(): bool
    {
        return $this->isAgentAccount() && $this->created_by !== $this->agent_id;
    }

    /** Whose account this is: the company name, "Admin" or the agent's name. */
    public function holderName(): string
    {
        return match (true) {
            (bool) $this->company_id => $this->company?->name ?? '?',
            (bool) $this->agent_id => $this->agent?->name ?? 'Agent',
            default => 'Admin',
        };
    }

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true);
    }

    public function scopeBanks(Builder $q): Builder
    {
        return $q->where('type', AccountType::Bank);
    }

    public function scopeCash(Builder $q): Builder
    {
        return $q->where('type', AccountType::Cash);
    }

    public function scopeAdminCashOnly(Builder $q): Builder
    {
        return $q->where('type', AccountType::Cash)->whereNull('company_id')->whereNull('agent_id');
    }

    /** Accounts that hold the business's money: company banks and the admin's cash (not agents'). */
    public function scopeBusiness(Builder $q): Builder
    {
        return $q->whereNull('agent_id')->where(fn ($q) => $q->whereNotNull('company_id')->orWhere('type', AccountType::Cash));
    }

    /** "HBL Current (HBL)" — without the holder. The admin's cash reads "Admin cash in hand". */
    public function shortLabel(): string
    {
        if ($this->isAdminCash()) {
            return 'Admin cash in hand';
        }

        return $this->isCash() || blank($this->bank_name) || str_contains($this->name, $this->bank_name)
            ? $this->name
            : "{$this->name} ({$this->bank_name})";
    }

    /** "Al-Noor Traders · HBL Current", "Admin cash in hand", "Agent Ali · Cash in hand" */
    public function label(): string
    {
        return $this->isAdminCash() ? $this->shortLabel() : $this->holderName().' · '.$this->shortLabel();
    }

    public function ledgerPostings(): array
    {
        if (! $this->company_id) {
            return []; // the admin's cash opens per company via OpeningBalance; agent accounts aren't used yet
        }

        return [[
            'type' => TransactionType::OpeningBalance,
            'date' => $this->opening_date ?? $this->created_at ?? now(),
            'lines' => [
                ['account' => LedgerAccount::Money, 'debit' => $this->opening_balance, 'account_id' => $this->id, 'company_id' => $this->company_id],
                ['account' => LedgerAccount::OpeningEquity, 'credit' => $this->opening_balance, 'company_id' => $this->company_id],
            ],
            'attributes' => [
                'company_id' => $this->company_id,
                'to_account_id' => $this->id,
                'description' => "Opening balance — {$this->shortLabel()}",
            ],
            'allowEmpty' => true,
        ]];
    }
}
