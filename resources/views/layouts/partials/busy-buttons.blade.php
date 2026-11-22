{{--
    A spinner on whatever was pressed, until its action finishes:
      - a button / link that starts a Livewire request: its icon turns into a spinner (one is
        added in front when it has no icon) and it can't be pressed again until the reply comes;
      - a link or plain form that opens another page: the same, until the next page appears;
      - a page link in the phone sidebar: the sidebar closes and the page loader shows.
    Opt out with data-no-busy; data-busy-ms="3000" ends a link's spinner after that time (downloads).
--}}
<style>
    .ams-spin {
        display: inline-block; width: 1em; height: 1em; flex-shrink: 0;
        border: .15em solid currentColor; border-right-color: transparent; border-radius: 50%;
        vertical-align: -.15em; animation: ams-spin .65s linear infinite;
    }
    .ams-spin.ams-spin-after { margin-left: .35em; }
    .ams-spin.ams-spin-before { margin-right: .35em; }
    @keyframes ams-spin { to { transform: rotate(360deg); } }
    [data-ams-busy] { pointer-events: none; cursor: progress; }
    .btn[data-ams-busy], .page-link[data-ams-busy], .dropdown-item[data-ams-busy] { opacity: .7; }
</style>
<script>
    (() => {
        const PRESSABLE = 'button, a[href], .btn, .page-link, [role=button]';
        const SKIP = '[data-no-busy], [data-bs-toggle], [data-bs-dismiss], .btn-close, .swal2-container *, .ams-select *';
        const busy = new Map();
        let pressed = null;

        const pressable = (target) => {
            const el = target instanceof Element ? target.closest(PRESSABLE) : null;
            return el && ! el.matches(SKIP) ? el : null;
        };

        function start(el, ms) {
            const state = busy.get(el);
            if (state) { state.count++; return; }
            const spin = document.createElement('span');
            spin.className = 'ams-spin';
            spin.setAttribute('aria-hidden', 'true');
            const icon = el.querySelector(':scope > i, :scope > .side_menu_icon > i');
            if (icon) {
                // Take the icon's place (keeping its spacing classes).
                icon.classList.forEach((c) => { if (! c.startsWith('ri-') && ! c.startsWith('bi-')) spin.classList.add(c); });
                icon.before(spin);
                icon.style.display = 'none';
            } else if (el.matches('.btn, .page-link, button, .dropdown-item')) {
                spin.classList.add('ams-spin-before');
                el.prepend(spin);
            } else {
                spin.classList.add('ams-spin-after');
                el.append(spin);
            }
            el.setAttribute('data-ams-busy', '');
            el.setAttribute('aria-busy', 'true');
            busy.set(el, { count: 1, spin, icon });
            if (ms) setTimeout(() => stop(el, true), ms);
        }

        function stop(el, all = false) {
            const state = busy.get(el);
            if (! state || (--state.count > 0 && ! all)) return;
            busy.delete(el);
            state.spin.remove();
            if (state.icon) state.icon.style.display = '';
            el.removeAttribute('data-ams-busy');
            el.removeAttribute('aria-busy');
        }

        const remember = (el) => { pressed = el ? { el, at: Date.now() } : null; };
        const take = () => {
            const p = pressed;
            pressed = null;
            return p && Date.now() - p.at < 1000 && p.el.isConnected ? p.el : null;
        };

        window.amsBusy = { start, stop, remember, pressed: () => pressed?.el ?? null };

        // Remember what was pressed; the Livewire request it starts (if any) picks it up.
        window.addEventListener('click', (e) => {
            const el = pressable(e.target);
            // A button-style label passes its click on to its radio/checkbox: keep the label.
            if (! el && pressed && (pressed.el.control === e.target || pressed.el.contains(e.target))) return;
            remember(el);
        }, true);
        window.addEventListener('submit', (e) => {
            remember(e.submitter && ! e.submitter.matches(SKIP) ? e.submitter : e.target.querySelector('[type=submit]:not([data-no-busy])'));
        }, true);
        // Typing or picking in a field is not a button press (unless it is the pressed button's own radio/checkbox).
        const forget = (e) => {
            const el = pressed?.el;
            if (el && el !== e.target && ! el.contains(e.target) && el.control !== e.target) pressed = null;
        };
        window.addEventListener('input', forget, true);
        window.addEventListener('change', forget, true);
        window.addEventListener('keydown', (e) => { if (e.key !== 'Enter' && e.key !== ' ') pressed = null; }, true);

        // Some template scripts stop clicks from bubbling, so these listen early and check, once every
        // handler has run, whether anything cancelled the default (Livewire / Alpine .prevent, dropdowns).
        const afterHandlers = (e, fn) => setTimeout(() => { if (! e.defaultPrevented) fn(); }, 0);

        // A plain form that posts and opens the next page (e.g. Sign out).
        window.addEventListener('submit', (e) => {
            const form = e.target;
            const el = pressed?.el;
            if ((form.target && form.target !== '_self') || ! el || ! form.contains(el)) return;
            afterHandlers(e, () => start(el, 15000));
        }, true);

        // A link that opens another page in this tab.
        window.addEventListener('click', (e) => {
            if (e.button !== 0 || e.ctrlKey || e.metaKey || e.shiftKey || e.altKey) return;
            const a = e.target instanceof Element ? e.target.closest('a[href]') : null;
            if (! a || a.matches(SKIP) || a.hasAttribute('download') || (a.target && a.target !== '_self')) return;
            const url = new URL(a.href, location.href);
            if (! /^https?:$/.test(url.protocol) || a.getAttribute('href').startsWith('#')) return;
            if (url.href.split('#')[0] === location.href.split('#')[0] && url.hash) return;

            afterHandlers(e, () => {
                const phoneMenu = a.closest('#smallScreenSidebar');
                if (phoneMenu) {
                    window.bootstrap?.Offcanvas.getOrCreateInstance(phoneMenu).hide();
                    document.getElementById('preloader')?.classList.remove('hidden');
                    return;
                }
                start(a, Number(a.dataset.busyMs) || 15000);
            });
        }, true);

        // Back/forward can show this page from the browser's memory: clear the spinners and loader.
        window.addEventListener('pageshow', (e) => {
            if (! e.persisted) return;
            [...busy.keys()].forEach((el) => stop(el, true));
            document.getElementById('preloader')?.classList.add('hidden');
        });

        document.addEventListener('livewire:init', () => {
            Livewire.hook('commit', ({ component, respond, fail }) => {
                const el = take();
                if (! el) return;
                start(el);
                let done = false;
                const end = () => { if (! done) { done = true; stop(el); } };
                respond(end);
                fail(end);
                setTimeout(end, 120000); // never leave a button stuck
            });
        });
    })();
</script>
