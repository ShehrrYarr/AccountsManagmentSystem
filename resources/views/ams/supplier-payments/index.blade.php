@extends('layouts.app')

@section('title', 'Supplier Payments')
@section('page-title', 'Supplier Payments')
@section('breadcrumb-parent', 'Money Out')

@section('page-actions')
    <a href="{{ route('supplier-payments.create') }}" class="btn btn-sm btn-primary"><i class="ri-add-circle-line me-1"></i>Pay Supplier</a>
@endsection

@section('content')
    <livewire:supplier-payments.manage />
    <livewire:supplier-payments.create />
@endsection
