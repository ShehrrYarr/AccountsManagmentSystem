@props(['label', 'value', 'icon' => 'ri-money-dollar-circle-line', 'color' => 'primary', 'hint' => null, 'href' => null])

<div {{ $attributes->merge(['class' => 'card h-100 mb-0']) }}>
    <div class="card-body">
        <div class="d-flex align-items-start gap-3">
            <div class="flex-grow-1 overflow-hidden">
                <p class="text-muted text-uppercase fs-12 fw-medium mb-2 text-truncate">{{ $label }}</p>
                <h4 class="fw-semibold mb-1 text-truncate">{{ $value }}</h4>
                @if ($hint)
                    <p class="fs-12 text-muted mb-0 text-truncate">{!! $hint !!}</p>
                @endif
            </div>
            <div class="avatar avatar-lg flex-shrink-0 rounded-3 bg-{{ $color }}-subtle text-{{ $color }} d-flex align-items-center justify-content-center">
                <i class="{{ $icon }} fs-24"></i>
            </div>
        </div>
        @if ($href)
            <a href="{{ $href }}" class="stretched-link" aria-label="{{ $label }}"></a>
        @endif
    </div>
</div>
