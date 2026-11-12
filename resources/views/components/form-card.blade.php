{{--
    Full-page counterpart of <x-modal>: same props and slot, rendered as a card, so one form
    can be shown either way with <x-dynamic-component :component="$asPage ? 'form-card' : 'modal'">.
--}}
@props(['id', 'title' => '', 'size' => 'lg', 'icon' => null, 'static' => true])

<div id="{{ $id }}" {{ $attributes->merge(['class' => 'card']) }}>
    <div class="card-header">
        <h5 class="card-title mb-0 d-flex align-items-center gap-2">
            @if ($icon)<i class="{{ $icon }} text-primary"></i>@endif
            {{ $title }}
        </h5>
    </div>
    {{ $slot }}
</div>
