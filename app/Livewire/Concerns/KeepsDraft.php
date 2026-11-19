<?php

namespace App\Livewire\Concerns;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Server side of the batch pages' browser draft (Deposit Cheque, Pay Department).
 *
 * The browser keeps the unsaved form and table (resources/views/layouts/partials/form-draft.blade.php)
 * and hands it back through the page's restoreDraft(). Because that data comes from the browser:
 *  - a picture path is accepted only if this user uploaded it for a table row and it is not saved yet
 *    (the paths are remembered here), so a restored row can never point at another record's file;
 *  - each batch carries a token, marked when "Save all" succeeds, so a stale copy left in the browser
 *    is thrown away instead of being saved twice.
 */
trait KeepsDraft
{
    public string $draftToken = '';

    private const DRAFT_DAYS = 8; // the browser forgets a draft after 7 days untouched

    protected function newDraftToken(): void
    {
        $this->draftToken = (string) Str::uuid();
    }

    protected function draftWasSaved(mixed $token): bool
    {
        return is_string($token) && $token !== '' && Cache::has('ams-draft-saved:'.$token);
    }

    /** "Save all" succeeded: the browser's copy is done with. */
    protected function markDraftSaved(array $paths): void
    {
        if ($this->draftToken !== '') {
            Cache::put('ams-draft-saved:'.$this->draftToken, true, now()->addDays(self::DRAFT_DAYS));
        }
        $this->forgetDraftFiles($paths); // they belong to saved records now
        $this->newDraftToken();
        $this->dispatch('draft-saved');
    }

    private function draftFilesKey(): string
    {
        return 'ams-draft-files:'.auth()->id();
    }

    /** A picture stored for a table row that is not saved yet. */
    protected function rememberDraftFile(?string $path): void
    {
        if ($path) {
            $files = Cache::get($this->draftFilesKey(), []);
            $files[] = $path;
            Cache::put($this->draftFilesKey(), array_values(array_unique($files)), now()->addDays(self::DRAFT_DAYS));
        }
    }

    protected function forgetDraftFiles(array $paths): void
    {
        $paths = array_filter($paths);
        if ($paths) {
            $files = array_values(array_diff(Cache::get($this->draftFilesKey(), []), $paths));
            Cache::put($this->draftFilesKey(), $files, now()->addDays(self::DRAFT_DAYS));
        }
    }

    /** The path, if it is one of this user's unsaved row pictures that is still on disk. */
    protected function draftFile(mixed $path, string $folder): ?string
    {
        if (! is_string($path) || ! str_starts_with($path, $folder.'/') || str_contains($path, '..')) {
            return null;
        }

        return in_array($path, Cache::get($this->draftFilesKey(), []), true) && Storage::disk('local')->exists($path) ? $path : null;
    }

    /** Delete unsaved row pictures (the draft was discarded). */
    protected function deleteDraftFiles(array $paths, string $folder): void
    {
        $paths = array_values(array_filter(array_map(fn ($p) => $this->draftFile($p, $folder), $paths)));
        foreach ($paths as $path) {
            Storage::disk('local')->delete($path);
        }
        $this->forgetDraftFiles($paths);
    }

    // Values from the browser, made safe to put back into the form.

    protected function draftText(mixed $value, int $max = 255): string
    {
        return is_scalar($value) ? mb_substr((string) $value, 0, $max) : '';
    }

    protected function draftId(mixed $value): ?int
    {
        return is_numeric($value) && (int) $value > 0 ? (int) $value : null;
    }

    protected function draftDate(mixed $value): string
    {
        return is_string($value) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $value) && strtotime($value) !== false ? $value : '';
    }

    protected function draftAmount(mixed $value): string
    {
        return is_numeric($value) ? (string) $value : '';
    }

    /** @return list<array> at most 200 array rows */
    protected function draftRows(mixed $rows): array
    {
        return array_values(array_filter(array_slice(is_array($rows) ? $rows : [], 0, 200), 'is_array'));
    }
}
