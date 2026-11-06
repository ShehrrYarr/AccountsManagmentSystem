{{--
    Bridges Livewire events to Herozi's native UI widgets:
      $this->dispatch('toast', type: 'success', message: '...')   -> SweetAlert2 toast
      $this->dispatch('modal-show', id: 'chequeModal')             -> Bootstrap modal open
      $this->dispatch('modal-hide', id: 'chequeModal')             -> Bootstrap modal close
    and offers window.amsConfirm() for SweetAlert2 confirmations.
--}}
<script>
    window.amsToast = function (type, message) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: type || 'success',
            title: message,
            showConfirmButton: false,
            timer: type === 'error' ? 6000 : 3500,
            timerProgressBar: true,
        });
    };

    window.amsConfirm = function (message, confirmText = 'Yes, continue', icon = 'warning') {
        return Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: icon,
            showCancelButton: true,
            confirmButtonText: confirmText,
            customClass: { confirmButton: 'btn btn-primary me-2', cancelButton: 'btn btn-light' },
            buttonsStyling: false,
        }).then(r => r.isConfirmed);
    };

    // Alpine logic for the searchable-select Blade component
    document.addEventListener('alpine:init', () => {
        Alpine.data('amsSelect', (options, placeholder, disabled, clearable) => ({
            options, placeholder, disabled, clearable,
            value: null,
            open: false,
            dropUp: false,
            menuMax: 280,
            search: '',
            hi: 0,
            init() {
                // Typing filters the list, so the highlighted row must restart at the top.
                this.$watch('search', () => { this.hi = 0; });
            },
            // Open upwards when the scroll area (modal body or window) has more room above.
            placeMenu() {
                const box = this.$el.getBoundingClientRect();
                const area = this.$el.closest('.modal-body, .table-responsive');
                const limits = area ? area.getBoundingClientRect() : { top: 0, bottom: window.innerHeight };
                // The menu may still be mid-transition (height 0), so estimate from the option count.
                const menu = this.$el.querySelector('.ams-select-menu');
                const estimate = Math.min(290, 60 + Math.max(1, this.filtered().length) * 40);
                const needed = (menu && menu.offsetHeight) || estimate;
                const below = limits.bottom - box.bottom;
                const above = box.top - limits.top;
                this.dropUp = needed > below && above > below;
                // Shrink the list to the room on the chosen side; it scrolls internally.
                this.menuMax = Math.max(150, Math.min(280, (this.dropUp ? above : below) - 8));
            },
            selected() {
                return this.options.find(o => String(o.value) === String(this.value)) || null;
            },
            filtered() {
                const q = this.search.trim().toLowerCase();
                if (!q) return this.options;
                return this.options.filter(o => (o.label + ' ' + (o.hint ?? '')).toLowerCase().includes(q));
            },
            toggle() {
                if (this.disabled) return;
                this.open = !this.open;
                if (this.open) {
                    this.dropUp = false;
                    this.search = '';
                    this.hi = Math.max(0, this.filtered().findIndex(o => String(o.value) === String(this.value)));
                    // Measure once the menu is rendered, then flip it if it would be cut off.
                    this.$nextTick(() => {
                        this.placeMenu();
                        this.$refs.search.focus();
                    });
                }
            },
            move(step) {
                const n = this.filtered().length;
                if (n) this.hi = (this.hi + step + n) % n;
            },
            choose(opt) {
                this.value = opt.value;
                this.open = false;
            },
            chooseHighlighted() {
                const list = this.filtered();
                const opt = list[Math.min(this.hi, list.length - 1)];
                if (opt) this.choose(opt);
            },
            clear() {
                this.value = null;
                this.open = false;
            },
        }));
    });

    // Dashboard charts (ApexCharts) — re-rendered in place on 'charts-refresh'
    document.addEventListener('alpine:init', () => {
        Alpine.data('amsCharts', (initial) => ({
            charts: {},
            init() {
                this.$nextTick(() => this.render(initial));
            },
            cssVar(name, fallback) {
                const v = getComputedStyle(document.documentElement).getPropertyValue(name).trim();
                return v || fallback;
            },
            money(v) {
                return 'Rs. ' + Number(v).toLocaleString('en-PK', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
            },
            base() {
                return {
                    chart: { fontFamily: 'inherit', toolbar: { show: false }, foreColor: this.cssVar('--bs-secondary-color', '#6c757d') },
                    dataLabels: { enabled: false },
                    tooltip: { y: { formatter: (v) => this.money(v) } },
                    grid: { borderColor: this.cssVar('--bs-border-color', '#e9ecef') },
                    noData: { text: 'No data yet' },
                };
            },
            options(data) {
                const primary = this.cssVar('--bs-primary', '#5b5bd6');
                const palette = [primary, '#22c55e', '#f59e0b', '#ef4444', '#06b6d4', '#8b5cf6', '#ec4899', '#64748b'];
                return {
                    monthly: {
                        ...this.base(),
                        chart: { ...this.base().chart, type: 'bar', height: 320 },
                        series: [
                            { name: 'Cheques cleared (in)', data: data.monthly.in },
                            { name: 'Paid to companies (out)', data: data.monthly.out },
                        ],
                        colors: ['#22c55e', '#f59e0b'],
                        plotOptions: { bar: { columnWidth: '55%', borderRadius: 4 } },
                        xaxis: { categories: data.monthly.labels },
                        yaxis: { labels: { formatter: (v) => this.money(v) } },
                        legend: { position: 'top' },
                    },
                    liquidity: {
                        ...this.base(),
                        chart: { ...this.base().chart, type: 'pie', height: 320 },
                        series: data.liquidity.values,
                        labels: data.liquidity.labels,
                        colors: palette,
                        legend: { position: 'bottom' },
                    },
                    topCompanies: {
                        ...this.base(),
                        chart: { ...this.base().chart, type: 'bar', height: 320 },
                        series: [{ name: 'Payable', data: data.topCompanies.values }],
                        colors: [primary],
                        plotOptions: { bar: { horizontal: true, borderRadius: 4, barHeight: '60%' } },
                        xaxis: { categories: data.topCompanies.labels, labels: { formatter: (v) => this.money(v) } },
                    },
                    payoutMix: {
                        ...this.base(),
                        chart: { ...this.base().chart, type: 'donut', height: 320 },
                        series: data.payoutMix.values,
                        labels: data.payoutMix.labels,
                        colors: ['#22c55e', primary, '#f59e0b'],
                        legend: { position: 'bottom' },
                        plotOptions: { pie: { donut: { size: '65%', labels: { show: true, total: { show: true, label: 'Total', formatter: (w) => this.money(w.globals.seriesTotals.reduce((a, b) => a + b, 0)) } } } } },
                    },
                };
            },
            render(data) {
                const opts = this.options(data);
                Object.keys(opts).forEach((key) => {
                    const el = this.$refs[key];
                    if (!el || typeof ApexCharts === 'undefined') return;
                    if (this.charts[key]) {
                        this.charts[key].updateOptions(opts[key], true, true);
                    } else {
                        this.charts[key] = new ApexCharts(el, opts[key]);
                        this.charts[key].render();
                    }
                });
            },
            destroy() {
                Object.values(this.charts).forEach((c) => c.destroy());
            },
        }));
    });

    // Link every .form-label to the field that follows it, so clicking the label focuses
    // the field and screen readers announce it. Re-applied after each Livewire morph.
    window.amsLinkLabels = (root = document) => {
        root.querySelectorAll('label.form-label:not([for])').forEach((label) => {
            const control = label.parentElement?.querySelector(
                'input:not([type=hidden]):not([type=checkbox]):not([type=radio]), select, textarea, .ams-select-toggle'
            );
            if (!control) return;
            if (!control.id) control.id = 'ams-f-' + Math.random().toString(36).slice(2, 10);
            label.htmlFor = control.id;
        });
    };
    document.addEventListener('DOMContentLoaded', () => window.amsLinkLabels());

    document.addEventListener('livewire:init', () => {
        Livewire.hook('morphed', ({ el }) => window.amsLinkLabels(el));
        Livewire.on('toast', (e) => window.amsToast(e.type, e.message));

        Livewire.on('modal-show', (e) => {
            const el = document.getElementById(e.id);
            if (el) bootstrap.Modal.getOrCreateInstance(el).show();
        });

        Livewire.on('modal-hide', (e) => {
            const el = document.getElementById(e.id);
            if (el) bootstrap.Modal.getOrCreateInstance(el).hide();
        });

        // Session expired: reload so the user lands on the login page instead of a broken modal.
        Livewire.hook('request', ({ fail }) => {
            fail(({ status, preventDefault }) => {
                if (status === 419) {
                    preventDefault();
                    window.location.reload();
                }
            });
        });
    });

    @if (session('toast'))
        document.addEventListener('DOMContentLoaded', () => window.amsToast(@js(session('toast.type', 'success')), @js(session('toast.message'))));
    @endif
</script>
