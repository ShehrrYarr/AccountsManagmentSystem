@extends('layouts.app')

@section('title', 'Opening Balances')
@section('page-title', 'Opening Balances')
@section('breadcrumb-parent', 'Setup')

@section('content')
    <livewire:opening-balances.manage />
    <livewire:accounts.manage :modal-only="true" />
@endsection
