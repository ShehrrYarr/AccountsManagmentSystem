@extends('layouts.app')

@section('title', 'Suppliers')
@section('page-title', 'Suppliers')
@section('breadcrumb-parent', 'Ledgers')

@section('content')
    <livewire:suppliers.list />
    <livewire:supplier-payments.manage :modal-only="true" />
@endsection
