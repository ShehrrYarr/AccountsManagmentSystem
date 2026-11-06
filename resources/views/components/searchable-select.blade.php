{{--
    Searchable dropdown bound to a Livewire property.

    <x-searchable-select wire:model.live="company_id" :options="$companyOptions" placeholder="Select company" />

    $options: list of ['value' => 1, 'label' => 'Acme', 'hint' => 'Rs. 1,000'] (hint optional)
    The element is re-keyed whenever the options change so Alpine picks up the new list.
--}}
@props(['options' => [], 'placeholder' => 'Select...', 'disabled' => false, 'invalid' => false, 'clearable' => true])

@php
    $model = $attributes->whereStartsWith('wire:model')->first();
    $key = 'ss-'.md5($model.json_encode($options).($disabled ? '1' : '0'));
@endphp

<div wire:key="{{ $key }}"
    x-data="amsSelect(@js(array_values($options)), @js($placeholder), @js((bool) $disabled), @js((bool) $clearable))"
    x-modelable="value"
    {{ $attributes->whereStartsWith('wire:model') }}
    {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class' => 'ams-select'.($invalid ? ' is-invalid' : '')]) }}
    x-bind:class="{ 'drop-up': dropUp }"
    x-on:click.outside="open = false"
    x-on:keydown.escape.prevent.stop="open = false">

    <button type="button" class="form-select ams-select-toggle {{ $invalid ? 'is-invalid' : '' }}" x-on:click="toggle()" x-bind:disabled="disabled">
        <span class="text-truncate" x-bind:class="{ 'placeholder-text': !selected() }" x-text="selected() ? selected().label : placeholder"></span>
    </button>

    <div class="ams-select-menu" x-show="open" x-cloak x-transition.opacity.duration.100ms>
        <div class="p-2 border-bottom d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Type to search..." x-ref="search" x-model="search"
                x-on:keydown.down.prevent="move(1)" x-on:keydown.up.prevent="move(-1)" x-on:keydown.enter.prevent="chooseHighlighted()">
            <button type="button" class="btn btn-sm btn-light" x-show="clearable && value" x-on:click="clear()" title="Clear"><i class="ri-close-line"></i></button>
        </div>
        <div class="ams-select-options">
            <template x-for="(opt, i) in filtered()" :key="opt.value">
                <div class="ams-select-option" x-bind:class="{ selected: opt.value == value, highlighted: i === hi }" x-on:click="choose(opt)" x-on:mouseenter="hi = i">
                    <span x-text="opt.label"></span>
                    <small x-text="opt.hint ?? ''"></small>
                </div>
            </template>
            <div x-show="filtered().length === 0" class="p-3 text-muted text-center fs-13">No matches</div>
        </div>
    </div>
</div>
