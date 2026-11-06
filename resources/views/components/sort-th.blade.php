{{-- Sortable table header: <x-sort-th field="date" :sort="$sortField" :dir="$sortDir">Date</x-sort-th> --}}
@props(['field', 'sort', 'dir' => 'desc'])

<th {{ $attributes->merge(['class' => 'sortable'.($sort === $field ? ' sorted' : '')]) }} wire:click="sortBy('{{ $field }}')">
    {{ $slot }}
    <i class="{{ $sort === $field ? ($dir === 'asc' ? 'ri-arrow-up-line' : 'ri-arrow-down-line') : 'ri-arrow-up-down-line' }} ms-1"></i>
</th>
