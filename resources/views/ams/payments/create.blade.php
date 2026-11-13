@extends('layouts.app')

@section('title', 'Pay Department')
@section('page-title', 'Pay Department')
@section('breadcrumb-parent')<a href="{{ route('payments.index') }}">{{ auth()->user()->isAdmin() ? 'Department Payments' : 'My Department Payments' }}</a>@endsection

@section('page-actions')
    <a href="{{ route('payments.index') }}" class="btn btn-sm btn-light">
        <i class="ri-arrow-left-line me-1"></i>All payments
    </a>
@endsection

@section('content')
    <livewire:payments.create :as-page="true" :company="request()->query('company')" :department="request()->query('department')" :method="request()->query('method')" />
@endsection
