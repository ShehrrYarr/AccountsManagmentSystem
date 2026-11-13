@php
    // Herozi's sidebar.js marks the active item by matching the URL path, so use paths, not absolute URLs.
    $path = fn (string $route) => '/'.ltrim(parse_url(route($route), PHP_URL_PATH) ?? '', '/');
    $item = function (string $route, string $icon, string $label, ?string $pattern = null, ?string $badge = null) use ($path) {
        $active = request()->routeIs($pattern ?? $route) ? ' active' : '';

        return '<li class="slide"><a href="'.e($path($route)).'" class="side-menu__item'.$active.'" role="menuitem">'
            .'<span class="side_menu_icon"><i class="'.e($icon).'"></i></span>'
            .'<span class="side-menu__label">'.e($label).'</span>'
            .($badge ? '<span class="badge bg-danger rounded-pill ms-auto">'.e($badge).'</span>' : '')
            .'</a></li>';
    };
    $isAdmin = auth()->user()?->isAdmin();
    $pending = $isAdmin ? \App\Models\ChequeChangeRequest::pending()->count() + \App\Models\PaymentChangeRequest::pending()->count() + \App\Models\Transfer::pending()->count() : 0;
@endphp
<ul class="main-menu" id="all-menu-items" role="menu">
    @if ($isAdmin)
        <li class="menu-title" role="presentation">Overview</li>
        {!! $item('dashboard', 'ri-dashboard-3-line', 'Dashboard') !!}
        {!! $item('approvals.index', 'ri-checkbox-multiple-line', 'Approvals', 'approvals.*', $pending ? (string) $pending : null) !!}
    @endif

    <li class="menu-title" role="presentation">Money In</li>
    {!! $item('cheques.index', 'ri-bank-card-line', $isAdmin ? 'Govt Cheques' : 'My Govt Cheques') !!}
    {!! $item('cheques.create', 'ri-add-circle-line', 'Deposit Cheque') !!}

    @unless ($isAdmin)
        <li class="menu-title" role="presentation">Money Out</li>
        {!! $item('payments.create', 'ri-add-circle-line', 'Pay Department') !!}
        {!! $item('payments.index', 'ri-hand-coin-line', 'My Department Payments') !!}

        <li class="menu-title" role="presentation">My Money</li>
        {!! $item('my-accounts', 'ri-wallet-3-line', 'My Accounts', 'my-accounts*') !!}
        {!! $item('my-ledger', 'ri-book-open-line', 'My Ledger') !!}
    @endunless

    @if ($isAdmin)
        <li class="menu-title" role="presentation">Money Out</li>
        {!! $item('payments.create', 'ri-add-circle-line', 'Pay Department') !!}
        {!! $item('payments.index', 'ri-hand-coin-line', 'Department Payments') !!}
        {!! $item('supplier-payments.index', 'ri-store-2-line', 'Supplier Payments', 'supplier-payments.*') !!}
        {!! $item('expenses.index', 'ri-receipt-line', 'Expenses', 'expenses.*') !!}
        {!! $item('transfers.index', 'ri-arrow-left-right-line', 'Transfers', 'transfers.*') !!}

        <li class="menu-title" role="presentation">Ledgers</li>
        {!! $item('companies.index', 'ri-building-2-line', 'Companies', 'companies.*') !!}
        {!! $item('accounts.index', 'ri-safe-2-line', 'Cash & Bank', 'accounts.*') !!}
        {!! $item('agents.index', 'ri-user-star-line', 'Agents', 'agents.*') !!}
        {!! $item('departments.index', 'ri-government-line', 'Departments', 'departments.*') !!}
        {!! $item('suppliers.index', 'ri-truck-line', 'Suppliers', 'suppliers.*') !!}
        {!! $item('transactions.index', 'ri-book-2-line', 'Transaction Journal', 'transactions.*') !!}

        <li class="menu-title" role="presentation">Setup</li>
        {!! $item('opening-balances.index', 'ri-flag-line', 'Opening Balances', 'opening-balances.*') !!}
        {!! $item('expense-categories.index', 'ri-price-tag-3-line', 'Expense Categories', 'expense-categories.*') !!}

        <li class="menu-title" role="presentation">Administration</li>
        {!! $item('users.index', 'ri-team-line', 'Users & Agents', 'users.*') !!}
        {!! $item('audit.index', 'ri-history-line', 'Audit Log', 'audit.*') !!}
    @endif
</ul>
