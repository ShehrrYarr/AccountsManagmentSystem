<?php

use App\Models\ApprovalRequest;

use function Livewire\Volt\{computed, on};

$count = computed(fn () => ApprovalRequest::pending()->count());

on(['transaction-updated' => fn () => null, 'approvals-updated' => fn () => null]);

?>

<span wire:poll.60s>
    @if ($this->count > 0)
        <span class="badge bg-danger rounded-pill">{{ $this->count }}</span>
    @endif
</span>
