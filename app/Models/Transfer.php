<?php

namespace App\Models;

use App\Enums\AccountType;
use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Models\Concerns\Auditable;
use App\Models\Concerns\HasTransactions;
use App\Models\Contracts\PostsToLedger;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Money moved between two accounts.
 *
 * Each side belongs to a company or to none: a bank to its company, the admin's cash in hand to
 * no company (it is one pot), and an agent's account to the company the advance / return is for
 * (from_company_id = to_company_id = that company on agent moves). Otherwise from_company_id /
 * to_company_id hold each side's company (null for the cash).
 *
 *   Same company       : Dr To account / Cr From account                    (bank to bank)
 *   Between companies  : A: Dr Inter-company(B) / Cr From account
 *                        B: Dr To account       / Cr Inter-company(A)        so B owes A until it is sent back
 *   Bank → cash        : A: Dr Moved-to-cash / Cr Bank;  pot: Dr Cash / Cr Moved-to-cash(A)
 *   Cash → bank        : the reverse: what A has moved to cash goes down
 *   Advance to agent   : Dr Agent(agent's account) / Cr From account          the agent owes it
 *   Return from agent  : Dr To account / Cr Agent(agent's account)            the agent owes less
 *   (an agent move through the cash pot is bridged by Moved-to-cash lines, like bank ↔ cash)
 *
 * A return an agent records is PENDING (posts nothing) until the admin approves it; a rejected
 * one never posts.
 */
class Transfer extends Model implements PostsToLedger
{
    use Auditable, HasTransactions, SoftDeletes;

    public const POSTED = 'posted';

    public const PENDING = 'pending';

    public const REJECTED = 'rejected';

    protected $fillable = [
        'from_company_id', 'from_account_id', 'to_company_id', 'to_account_id', 'amount', 'date', 'reference', 'notes',
        'status', 'created_by', 'decided_by', 'decided_at', 'decision_note',
    ];

    protected $attributes = ['status' => self::POSTED];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2', 'date' => 'date', 'decided_at' => 'datetime'];
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

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function decider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'decided_by');
    }

    public function scopePosted(Builder $q): Builder
    {
        return $q->where('status', self::POSTED);
    }

    public function scopePending(Builder $q): Builder
    {
        return $q->where('status', self::PENDING);
    }

    /** Transfers touching any of this agent's accounts. */
    public function scopeForAgent(Builder $q, int $agentId): Builder
    {
        $ids = Account::withTrashed()->where('agent_id', $agentId)->pluck('id');

        return $q->where(fn ($q) => $q->whereIn('from_account_id', $ids)->orWhereIn('to_account_id', $ids));
    }

    public function isPosted(): bool
    {
        return $this->status === self::POSTED;
    }

    public function isPending(): bool
    {
        return $this->status === self::PENDING;
    }

    /** Between two of my companies' banks (not through the cash pot, not an agent move). */
    public function isInterCompany(): bool
    {
        return $this->from_company_id && $this->to_company_id && (int) $this->from_company_id !== (int) $this->to_company_id;
    }

    /** The company a side's journal lines belong to; null for the admin's cash pot. */
    public function companyOf(Account $account): ?int
    {
        return match (true) {
            $account->isAgentAccount() => $this->from_company_id ? (int) $this->from_company_id : null,
            (bool) $account->company_id => (int) $account->company_id,
            default => null,
        };
    }

    public function isAdvance(): bool
    {
        return (bool) $this->toAccount?->isAgentAccount();
    }

    public function isAgentReturn(): bool
    {
        return (bool) $this->fromAccount?->isAgentAccount();
    }

    public function isAgentMove(): bool
    {
        return $this->isAdvance() || $this->isAgentReturn();
    }

    /** The agent's account on an advance or return. */
    public function agentAccount(): ?Account
    {
        return $this->isAdvance() ? $this->toAccount : ($this->isAgentReturn() ? $this->fromAccount : null);
    }

    /** Plain-language kind of move, e.g. "Cash withdrawal". */
    public function kind(): string
    {
        $from = $this->fromAccount->type;
        $to = $this->toAccount->type;

        return match (true) {
            $this->isAdvance() => 'Advance to agent',
            $this->isAgentReturn() => 'Return from agent',
            $this->isInterCompany() => 'Inter-company transfer',
            $from === AccountType::Bank && $to === AccountType::Cash => 'Moved to cash',
            $from === AccountType::Cash && $to === AccountType::Bank => 'Cash deposit',
            default => 'Bank to bank transfer',
        };
    }

    public function describe(): string
    {
        $from = $this->fromAccount;
        $to = $this->toAccount;
        $ref = $this->reference ? " — ref {$this->reference}" : '';

        return match (true) {
            $this->isAdvance() => "Advance to {$to->holderName()} ({$to->shortLabel()}) from {$from->shortLabel()}{$ref}",
            $this->isAgentReturn() => "Returned by {$from->holderName()} ({$from->shortLabel()}) to {$to->shortLabel()}{$ref}",
            $this->isInterCompany() => "Transfer from {$this->fromCompany?->name} ({$from->shortLabel()}) to {$this->toCompany?->name} ({$to->shortLabel()}){$ref}",
            $from->isAdminCash() || $to->isAdminCash() => "{$this->kind()}: {$from->label()} → {$to->label()}{$ref}",
            default => "{$this->kind()}: {$from->shortLabel()} → {$to->shortLabel()}{$ref}",
        };
    }

    public function ledgerPostings(): array
    {
        if (! $this->isPosted()) {
            return []; // waiting for (or refused) the admin's approval
        }

        $from = $this->fromAccount;
        $to = $this->toAccount;
        $side = fn (Account $a) => $a->isAgentAccount() ? LedgerAccount::Agent : LedgerAccount::Money;

        $fromCo = $this->companyOf($from);
        $toCo = $this->companyOf($to);

        $lines = [
            ['account' => $side($to), 'debit' => $this->amount, 'company_id' => $toCo, 'account_id' => $to->id],
            ['account' => $side($from), 'credit' => $this->amount, 'company_id' => $fromCo, 'account_id' => $from->id],
        ];

        // The two sides belong to different groups: bridge them so each group balances.
        if ($fromCo !== $toCo) {
            $bridge = $fromCo && $toCo ? LedgerAccount::InterCompany : LedgerAccount::CashPot;
            $lines[] = ['account' => $bridge, 'debit' => $this->amount, 'company_id' => $fromCo, 'counterparty_company_id' => $toCo];
            $lines[] = ['account' => $bridge, 'credit' => $this->amount, 'company_id' => $toCo, 'counterparty_company_id' => $fromCo];
        }

        return [[
            'type' => match (true) {
                $this->isAdvance() => TransactionType::AgentAdvance,
                $this->isAgentReturn() => TransactionType::AgentReturn,
                $this->isInterCompany() => TransactionType::InterCompanyTransfer,
                default => TransactionType::AccountTransfer,
            },
            'date' => $this->date,
            'lines' => $lines,
            'attributes' => [
                'company_id' => $this->from_company_id ?? $this->to_company_id,
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
