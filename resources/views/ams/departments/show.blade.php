@extends('layouts.app')

@section('title', $department->name)
@section('page-title', $department->name)
@section('breadcrumb-parent')
    <a href="{{ route('departments.index') }}">Departments</a>
@endsection

@section('page-actions')
    <div x-data class="d-flex gap-2 flex-wrap">
        <button type="button" class="btn btn-sm btn-primary" x-on:click="Livewire.dispatch('cheque-create', { departmentId: {{ $department->id }} })"><i class="ri-bank-card-line me-1"></i>Receive Cheque</button>
        <button type="button" class="btn btn-sm btn-success" x-on:click="Livewire.dispatch('payment-create', { departmentId: {{ $department->id }} })"><i class="ri-hand-coin-line me-1"></i>Pay / Spend</button>
        <button type="button" class="btn btn-sm btn-light" x-on:click="Livewire.dispatch('deal-close', { departmentId: {{ $department->id }} })"><i class="ri-flag-2-line me-1"></i>Close Deal</button>
    </div>
@endsection

@section('content')
    @if ($department->code || $department->city || $department->contact_person || $department->phone)
        <div class="card"><div class="card-body d-flex flex-wrap gap-4 fs-13">
            @if ($department->code)<span><span class="text-muted">Code</span> <strong>{{ $department->code }}</strong></span>@endif
            @if ($department->city)<span><span class="text-muted">City</span> <strong>{{ $department->city }}</strong></span>@endif
            @if ($department->contact_person)<span><span class="text-muted">Contact</span> <strong>{{ $department->contact_person }}</strong></span>@endif
            @if ($department->phone)<span><span class="text-muted">Phone</span> <strong>{{ $department->phone }}</strong></span>@endif
        </div></div>
    @endif

    <livewire:departments.balances :department-id="$department->id" />

    <ul class="nav nav-tabs my-3 flex-nowrap overflow-x-auto overflow-y-hidden text-nowrap" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-ledger" type="button">Ledger</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-cheques" type="button">Cheques</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-payments" type="button">Payments</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-closings" type="button">Closed deals</button></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab-ledger"><livewire:statements.ledger kind="department" :subject-id="$department->id" /></div>
        <div class="tab-pane fade" id="tab-cheques"><livewire:cheques.list :department-id="$department->id" /></div>
        <div class="tab-pane fade" id="tab-payments"><livewire:payments.list :department-id="$department->id" /></div>
        <div class="tab-pane fade" id="tab-closings"><livewire:departments.closings :department-id="$department->id" /></div>
    </div>

    <livewire:cheques.register-cheque />
    <livewire:cheques.deposit-cheque />
    <livewire:payments.create />
    <livewire:departments.close-deal />
@endsection
