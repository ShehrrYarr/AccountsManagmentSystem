<?php

namespace App\Livewire\Concerns;

use App\Exceptions\BusinessRuleException;
use App\Services\Outcome;
use Closure;
use Illuminate\Http\UploadedFile;

/**
 * Shared helpers for AMS Volt components:
 *   - run a service call and turn accounting-rule violations into field errors + toasts
 *   - fire Herozi toasts / modals and the global refresh event
 */
trait InteractsWithUi
{
    /**
     * Run $callback; on a BusinessRuleException show the message and return false.
     */
    protected function attempt(Closure $callback, string $fallbackField = 'general'): mixed
    {
        try {
            return $callback() ?? true;
        } catch (BusinessRuleException $e) {
            $this->addError($e->field ?? $fallbackField, $e->getMessage());
            $this->toast('error', $e->getMessage());

            return false;
        }
    }

    protected function toast(string $type, string $message): void
    {
        $this->dispatch('toast', type: $type, message: $message);
    }

    /** Toast for an action that may have gone to the approval queue. */
    protected function toastOutcome(Outcome $outcome, string $doneMessage, string $what = 'Your request'): void
    {
        $this->toast($outcome->toastType(), $outcome->message($doneMessage, $what));
    }

    protected function showModal(string $id): void
    {
        $this->dispatch('modal-show', id: $id);
    }

    protected function hideModal(string $id): void
    {
        $this->dispatch('modal-hide', id: $id);
    }

    /** Tell every listening component (stats, charts, tables) that money moved. */
    protected function broadcastChange(): void
    {
        $this->dispatch('transaction-updated');
    }

    /** Store a Livewire temporary upload privately and return its path. */
    protected function storeUpload(?UploadedFile $file, string $folder): ?string
    {
        return $file?->store($folder.'/'.now()->format('Y/m'), 'local');
    }
}
