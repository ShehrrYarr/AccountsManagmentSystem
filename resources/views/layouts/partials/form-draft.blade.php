{{--
    Keeps a batch-entry page's unsaved work in this browser, so a reload, a dropped connection or an
    expired sign-in loses nothing (Deposit Cheque and Pay Department pages).

    Page view:   @include('layouts.partials.form-draft')          (once, adds window.amsDraft)
    Component:   <div x-data="amsDraft({ key, fields, itemFields })" x-on:draft-saved.window="clear()">
                     @include('layouts.partials.form-draft-notice') ...

    - The listed Livewire properties are copied to localStorage as you type and after every server
      round trip; a picture chosen but not yet added goes to IndexedDB (localStorage can't hold files).
    - On load, a copy younger than 7 days is handed to the component's restoreDraft(), which checks it,
      and the picture is attached again. A notice offers "Discard" (the component's discardDraft()).
    - "Save all" succeeding dispatches draft-saved, which wipes the copy.
    - The key includes the user id, so someone else signing in on this browser never sees it.
--}}
@once
@push('scripts')
<script>
    window.amsDraft = function (cfg) {
        const WEEK = 7 * 24 * 60 * 60 * 1000;

        // The picture of the entry being typed, in IndexedDB under the same key.
        const files = (mode, act) => new Promise((resolve) => {
            try {
                const open = indexedDB.open('ams-drafts', 1);
                open.onupgradeneeded = () => open.result.createObjectStore('files');
                open.onerror = () => resolve(null);
                open.onsuccess = () => {
                    const db = open.result;
                    const tx = db.transaction('files', mode);
                    const req = act(tx.objectStore('files'));
                    tx.oncomplete = () => { db.close(); resolve(req ? req.result : null); };
                    tx.onerror = tx.onabort = () => { db.close(); resolve(null); };
                };
            } catch (e) { resolve(null); }
        });
        const getFile = () => files('readonly', s => s.get(cfg.key));
        const putFile = (f) => files('readwrite', s => s.put(f, cfg.key));
        const delFile = () => files('readwrite', s => s.delete(cfg.key));

        return {
            restoredAt: null,
            offline: ! navigator.onLine,
            unreachable: false,
            ready: false,
            dirty: false,
            pic: 'none',   // none | uploading | uploaded | failed
            timer: null,

            init() {
                const root = this.$root;
                const changed = (e) => {
                    if (! this.ready || e.target.closest('[data-draft-ignore]')) return;
                    this.dirty = true;
                    clearTimeout(this.timer);
                    this.timer = setTimeout(() => this.save(), 300);
                };
                ['input', 'change', 'click', 'keyup'].forEach(t => root.addEventListener(t, changed));

                root.addEventListener('change', (e) => {
                    if (e.target.matches('input[type=file]') && e.target.files && e.target.files[0]) {
                        putFile(e.target.files[0]);
                        this.pic = 'uploading';
                    }
                });
                root.addEventListener('livewire-upload-error', () => this.pic = 'failed');
                root.addEventListener('livewire-upload-cancel', () => this.pic = 'failed');

                window.addEventListener('offline', () => this.offline = true);
                window.addEventListener('online', () => { this.offline = false; this.retryPicture(); });

                // respond() runs when the request is over (succeed() waits for an animation frame,
                // which a background tab never gets).
                Livewire.hook('commit', ({ component, respond, fail }) => {
                    if (component.id !== this.$wire.$id) return;
                    let failed = false;
                    fail(() => { failed = true; this.unreachable = true; });
                    respond(() => setTimeout(() => {
                        if (! failed) this.unreachable = false;
                        this.afterCommit();
                    }, 30));
                });

                this.restore().finally(() => this.ready = true);
            },

            fileInput() {
                return this.$root.querySelector('input[type=file]');
            },

            afterCommit() {
                // Read the upload state from the property: Livewire's upload events can be lost when the
                // file input is redrawn mid-upload.
                if (this.$wire[cfg.file]) {
                    this.pic = 'uploaded';
                } else if (this.pic === 'uploaded') {
                    // The server dropped the picture (added to the table, saved, row edit): forget our copy.
                    this.pic = 'none';
                    delFile();
                    const input = this.fileInput();
                    if (input) input.value = '';
                }
                if (this.ready) this.save();
            },

            snapshot() {
                const data = {};
                cfg.fields.forEach(f => data[f] = this.$wire[f]);
                // What is in the boxes right now: a wire:model.blur / debounced field reaches $wire later.
                this.$root.querySelectorAll('input, textarea').forEach(el => {
                    const attr = [...el.attributes].find(a => a.name.startsWith('wire:model'));
                    if (! attr || ! (attr.value in data) || el.type === 'file' || el.type === 'checkbox') return;
                    if (el.type !== 'radio' || el.checked) data[attr.value] = el.value;
                });
                return JSON.parse(JSON.stringify(data));
            },

            hasContent(data) {
                return (data.rows || []).length > 0 || cfg.itemFields.some(f => data[f] !== null && data[f] !== undefined && String(data[f]).trim() !== '');
            },

            save() {
                if (! this.ready) return;
                const data = this.snapshot();
                if (! this.dirty && ! this.hasContent(data)) return;
                try { localStorage.setItem(cfg.key, JSON.stringify({ at: Date.now(), data })); } catch (e) {}
            },

            async restore() {
                let kept = null;
                try { kept = JSON.parse(localStorage.getItem(cfg.key) || 'null'); } catch (e) {}
                const file = await getFile();
                if (! kept || ! kept.data || Date.now() - (kept.at || 0) > WEEK) {
                    this.clear();
                    return;
                }
                let res = null;
                try { res = await this.$wire.restoreDraft(kept.data); } catch (e) { return; }
                if (! res || ! res.restored) {
                    this.clear();
                    return;
                }
                if (file) this.attach(file);
                if (file || this.hasContent(kept.data)) this.restoredAt = new Date(kept.at);
                this.dirty = true;
            },

            // Put the kept picture back into the file input; Livewire uploads it as if it was chosen.
            attach(file) {
                const input = this.fileInput();
                if (! input || typeof DataTransfer === 'undefined') return;
                try {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    input.files = dt.files;
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                } catch (e) {}
            },

            async retryPicture() {
                if (this.pic === 'uploaded') return;
                const file = await getFile();
                if (file && ! this.$wire[cfg.file]) this.attach(file);
            },

            clear() {
                clearTimeout(this.timer);
                this.dirty = false;
                this.restoredAt = null;
                this.pic = 'none';
                try { localStorage.removeItem(cfg.key); } catch (e) {}
                delFile();
            },

            async discard() {
                if (! await amsConfirm('Throw away the unsaved entries on this page? Rows in the table and their pictures are removed.', 'Discard')) return;
                await this.$wire.discardDraft();
                this.clear();
                const input = this.fileInput();
                if (input) input.value = '';
            },

            restoredLabel() {
                return this.restoredAt ? this.restoredAt.toLocaleString('en-GB', { day: 'numeric', month: 'short', hour: 'numeric', minute: '2-digit', hour12: true }).replace(/\b(am|pm)\b/, m => m.toUpperCase()) : '';
            },
        };
    };
</script>
@endpush
@endonce
