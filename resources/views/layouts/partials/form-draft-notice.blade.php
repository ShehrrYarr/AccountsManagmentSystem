{{-- Notices for a page using amsDraft (see form-draft.blade.php): offline, and "restored". --}}
<div wire:ignore data-draft-ignore>
    <div class="d-none alert alert-warning d-flex align-items-center gap-2 py-2 fs-13" x-bind:class="{ 'd-none': ! (offline || unreachable) }">
        <i class="ri-wifi-off-line fs-18"></i>
        <div><strong x-text="offline ? 'You are offline.' : 'Can\'t reach the server.'"></strong>
            Keep typing: everything is kept on this device. <strong>Add to table</strong> and <strong>Save all</strong> work again once the connection is back.</div>
    </div>
    <div class="d-none alert alert-info d-flex align-items-center gap-2 py-2 fs-13" x-bind:class="{ 'd-none': ! restoredAt }">
        <i class="ri-history-line fs-18"></i>
        <div class="me-auto">Restored your unsaved entries from <strong x-text="restoredLabel()"></strong>.</div>
        <button type="button" class="btn btn-sm btn-light-danger" x-on:click="discard()"><i class="ri-delete-bin-line me-1"></i>Discard</button>
        <button type="button" class="btn-close" aria-label="Hide" x-on:click="restoredAt = null"></button>
    </div>
</div>
