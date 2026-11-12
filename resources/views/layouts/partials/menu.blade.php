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

    <li class="menu-title" role="presentation">Money In</li>
    {!! $item('cheques.index', 'ri-bank-card-line', 'Govt Cheques') !!}
    {!! $item('cheques.create', 'ri-add-circle-line', 'Deposit Cheque') !!}

    <li class="menu-title" role="presentation">Money Out</li>
    {!! $item('payments.index', 'ri-hand-coin-line', 'Department Payments', 'payments.*') !!}
    {!! $item('supplier-payments.index', 'ri-store-2-line', 'Supplier Payments', 'supplier-payments.*') !!}
    {!! $item('expenses.index', 'ri-receipt-line', 'Expenses', 'expenses.*') !!}
    {!! $item('transfers.index', 'ri-arrow-left-right-line', 'Transfers', 'transfers.*') !!}

    <li class="menu-title" role="presentation">Ledgers</li>
    {!! $item('companies.index', 'ri-building-2-line', 'Companies', 'companies.*') !!}
    {!! $item('accounts.index', 'ri-safe-2-line', 'Cash & Bank', 'accounts.*') !!}
    {!! $item('departments.index', 'ri-government-line', 'Departments', 'departments.*') !!}
    {!! $item('suppliers.index', 'ri-truck-line', 'Suppliers', 'suppliers.*') !!}
    {!! $item('transactions.index', 'ri-book-2-line', 'Transaction Journal', 'transactions.*') !!}

    <li class="menu-title" role="presentation">Setup</li>
    {!! $item('opening-balances.index', 'ri-flag-line', 'Opening Balances', 'opening-balances.*') !!}
    {!! $item('expense-categories.index', 'ri-price-tag-3-line', 'Expense Categories', 'expense-categories.*') !!}

    @can('admin')
        <li class="menu-title" role="presentation">Administration</li>
        {!! $item('users.index', 'ri-team-line', 'Users', 'users.*') !!}
        {!! $item('audit.index', 'ri-history-line', 'Audit Log', 'audit.*') !!}
    @endcan
</ul>
