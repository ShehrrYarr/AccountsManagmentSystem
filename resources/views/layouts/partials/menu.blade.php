@php
    // Herozi's sidebar.js marks the active item by matching the URL path, so use paths, not absolute URLs.
    $path = fn (string $route) => '/'.ltrim(parse_url(route($route), PHP_URL_PATH) ?? '', '/');
    $item = function (string $route, string $icon, string $label, ?string $pattern = null) use ($path) {
        $active = request()->routeIs($pattern ?? $route) ? ' active' : '';

        return '<li class="slide"><a href="'.e($path($route)).'" class="side-menu__item'.$active.'" role="menuitem">'
            .'<span class="side_menu_icon"><i class="'.e($icon).'"></i></span>'
            .'<span class="side-menu__label">'.e($label).'</span></a></li>';
    };
@endphp
<ul class="main-menu" id="all-menu-items" role="menu">
    <li class="menu-title" role="presentation">Overview</li>
    {!! $item('dashboard', 'ri-dashboard-3-line', 'Dashboard') !!}

    <li class="menu-title" role="presentation">Cash In</li>
    {!! $item('cheques.index', 'ri-bank-card-line', 'Government Cheques', 'cheques.*') !!}

    <li class="menu-title" role="presentation">Cash Out</li>
    {!! $item('disbursements.index', 'ri-hand-coin-line', 'Disbursements', 'disbursements.*') !!}
    {!! $item('transfers.index', 'ri-arrow-left-right-line', 'Internal Transfers', 'transfers.*') !!}

    <li class="menu-title" role="presentation">Ledger</li>
    {!! $item('transactions.index', 'ri-book-2-line', 'Transaction Journal', 'transactions.*') !!}
    @can('admin')
        {!! $item('adjustments.index', 'ri-scales-3-line', 'Adjustments', 'adjustments.*') !!}
        <li class="slide">
            <a href="{{ $path('approvals.index') }}" class="side-menu__item{{ request()->routeIs('approvals.*') ? ' active' : '' }}" role="menuitem">
                <span class="side_menu_icon"><i class="ri-checkbox-multiple-line"></i></span>
                <span class="side-menu__label">Approvals</span>
                <livewire:layout.approval-count />
            </a>
        </li>
    @endcan

    <li class="menu-title" role="presentation">Master Data</li>
    {!! $item('companies.index', 'ri-building-2-line', 'Companies', 'companies.*') !!}
    {!! $item('bank-accounts.index', 'ri-safe-2-line', 'My Accounts', 'bank-accounts.*') !!}
    {!! $item('vendors.index', 'ri-store-2-line', 'Vendors', 'vendors.*') !!}
    {!! $item('departments.index', 'ri-government-line', 'Govt Departments', 'departments.*') !!}

    @can('admin')
        <li class="menu-title" role="presentation">Administration</li>
        {!! $item('users.index', 'ri-team-line', 'Users', 'users.*') !!}
        {!! $item('audit.index', 'ri-history-line', 'Audit Log', 'audit.*') !!}
    @endcan
</ul>
