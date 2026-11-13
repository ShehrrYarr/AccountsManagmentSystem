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
 * Each side names its company (from_company_id / to_company_id): a bank says it itself, and the
 * admin's cash in hand is shared, so the form asks which company the cash side is for.
 *
 *   Same company       : Dr To account / Cr From account     (ATM withdrawal, cash deposit, bank to bank)
 *   Between companies  : A: Dr Inter-company(B) / Cr From account
 *                        B: Dr To account       / Cr Inter-company(A)
 *                        so B owes A until the money is sent back.
 *   Advance to agent   : Dr Agent(agent's account) / Cr From account    — the agent owes it
 *   Return from agent  : Dr To account / Cr Agent(agent's account)      — the agent owes less
 *
 * Agent moves stay inside one company. A return an agent records is PENDING (posts nothing)
 * until the admin approves it; a rejected one never posts.
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

    public function isInterCompany(): bool
    {
        return (int) $this->from_company_id !== (int) $this->to_company_id;
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

        return match (true) {
            $this->isAdvance() => "Advance to {$to->holderName()} ({$to->shortLabel()}) from {$from->shortLabel()}{$ref}",
            $this->isAgentReturn() => "Returned by {$from->holderName()} ({$from->shortLabel()}) to {$to->shortLabel()}{$ref}",
            $this->isInterCompany() => "Transfer from {$this->fromCompany?->name} ({$from->shortLabel()}) to {$this->toCompany?->name} ({$to->shortLabel()}){$ref}",
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

        $lines = [
            ['account' => $side($to), 'debit' => $this->amount, 'company_id' => $this->to_company_id, 'account_id' => $to->id],
            ['account' => $side($from), 'credit' => $this->amount, 'company_id' => $this->from_company_id, 'account_id' => $from->id],
        ];

        if ($this->isInterCompany()) {
            $lines[] = ['account' => LedgerAccount::InterCompany, 'debit' => $this->amount, 'company_id' => $this->from_company_id, 'counterparty_company_id' => $this->to_company_id];
            $lines[] = ['account' => LedgerAccount::InterCompany, 'credit' => $this->amount, 'company_id' => $this->to_company_id, 'counterparty_company_id' => $this->from_company_id];
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
