{{--
    Herozi / Bootstrap modal that survives Livewire re-renders.
    Open / close from a Volt component with:
        $this->dispatch('modal-show', id: 'myModal');
        $this->dispatch('modal-hide', id: 'myModal');
--}}
@props(['id', 'title' => '', 'size' => 'lg', 'icon' => null, 'static' => true])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true"
    wire:ignore.self @if ($static) data-bs-backdrop="static" data-bs-keyboard="false" @endif>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-{{ $size }}">
        <div {{ $attributes->merge(['class' => 'modal-content']) }}>
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center gap-2" id="{{ $id }}Label">
                    @if ($icon)<i class="{{ $icon }} text-primary"></i>@endif
                    {{ $title }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ $slot }}
        </div>
    </div>
</div>
