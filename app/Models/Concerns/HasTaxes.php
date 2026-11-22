<?php

namespace App\Models\Concerns;

use App\Enums\LedgerAccount;
use App\Enums\TransactionType;
use App\Models\PaymentTax;
use App\Support\Money;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Taxes paid on a bank payment (department or supplier payment). They leave the same bank on
 * top of the payment and are the company's cost. Each tax posts its own transaction, so a bank
 * statement shows it on its own line under the payment.
 */
trait HasTaxes
{
    /**
     * Taxes from the form, saved together with the document by PaymentService
     * (list of ['tax_id' => int, 'amount' => string]); null leaves the saved ones as they are.
     */
    public ?array $pendingTaxes = null;

    public function taxes(): MorphMany
    {
        return $this->morphMany(PaymentTax::class, 'taxable')->orderBy('id');
    }

    /** What the taxes add up to (the saved ones, or the pending ones before a save). */
    public function taxTotal(): string
    {
        $amounts = $this->pendingTaxes !== null ? array_column($this->pendingTaxes, 'amount') : $this->taxes->pluck('amount')->all();

        return Money::add('0', ...$amounts);
    }

    /**
     * One posting per tax:  Dr Tax / Cr the money account the payment came from.
     *
     * @param  array<string, mixed>  $attributes  Transaction columns (company, department / supplier, account, reference)
     */
    protected function taxPostings(LedgerAccount $from, ?int $accountId, string $about, array $attributes): array
    {
        return $this->taxes()->with('tax')->get()->map(fn (PaymentTax $t) => [
            'type' => TransactionType::Tax,
            'date' => $this->date,
            'lines' => [
                ['account' => LedgerAccount::Tax, 'debit' => $t->amount, 'company_id' => $this->company_id, 'tax_id' => $t->tax_id],
                ['account' => $from, 'credit' => $t->amount, 'company_id' => $this->company_id, 'account_id' => $accountId],
            ],
            'attributes' => $attributes + [
                'amount' => $t->amount,
                'description' => "{$t->tax?->name} on: {$about}",
            ],
        ])->all();
    }
}
