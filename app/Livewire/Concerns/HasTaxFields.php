<?php

namespace App\Livewire\Concerns;

use App\Models\Tax;
use App\Support\Money;
use Illuminate\Database\Eloquent\Model;

/**
 * The "Taxes" rows on the Pay Department and Pay Supplier forms: a tax and an amount per row,
 * paid from the same bank on top of the payment. The admin can add a new tax name in place.
 * Markup: resources/views/partials/payment-taxes.blade.php
 */
trait HasTaxFields
{
    /** @var list<array{tax_id: int|null, amount: string}> */
    public array $taxes = [];

    public bool $addingTax = false;

    public string $newTax = '';

    public function addTaxRow(): void
    {
        if (count($this->taxes) < 10) {
            $this->taxes[] = ['tax_id' => null, 'amount' => ''];
        }
    }

    public function removeTaxRow(int $i): void
    {
        unset($this->taxes[$i]);
        $this->taxes = array_values($this->taxes);
        $this->resetErrorBag();
    }

    /** Only the admin adds tax names; the new one goes into the first empty row (or a new row). */
    public function addTax(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);
        $this->validate(['newTax' => ['required', 'string', 'max:255', 'unique:taxes,name']], [], ['newTax' => 'tax name']);
        $tax = Tax::create(['name' => trim($this->newTax), 'is_active' => true]);

        $empty = collect($this->taxes)->search(fn ($t) => empty($t['tax_id']));
        if ($empty !== false) {
            $this->taxes[$empty]['tax_id'] = $tax->id;
        } else {
            $this->taxes[] = ['tax_id' => $tax->id, 'amount' => ''];
        }
        $this->fill(['newTax' => '', 'addingTax' => false]);
    }

    /** Active taxes, plus any turned-off one already chosen here. */
    public function taxOptions(): array
    {
        $chosen = collect($this->taxes)->pluck('tax_id')->filter()->all();

        return Tax::query()->where(fn ($q) => $q->where('is_active', true)->orWhereIn('id', $chosen))->orderBy('name')->get()
            ->map(fn (Tax $t) => ['value' => $t->id, 'label' => $t->name.($t->is_active ? '' : ' (turned off)')])->all();
    }

    protected function taxRowsOf(Model $payment): array
    {
        return $payment->taxes->map(fn ($t) => ['tax_id' => $t->tax_id, 'amount' => $t->amount])->values()->all();
    }

    /** Tax rows from the browser's kept copy, made safe. */
    protected function cleanTaxRows(mixed $rows): array
    {
        return collect(is_array($rows) ? array_slice($rows, 0, 10) : [])
            ->filter(fn ($t) => is_array($t))
            ->map(fn ($t) => [
                'tax_id' => is_numeric($t['tax_id'] ?? null) && (int) $t['tax_id'] > 0 ? (int) $t['tax_id'] : null,
                'amount' => is_numeric($t['amount'] ?? null) ? (string) $t['amount'] : '',
            ])->values()->all();
    }

    protected static function sumTaxes(array $rows): string
    {
        return Money::add('0', ...array_map(fn ($t) => is_numeric($t['amount'] ?? null) ? $t['amount'] : 0, $rows));
    }
}
