@extends('layouts.app')

@section('title', 'My Accounts')
@section('page-title', 'My Accounts')
@section('breadcrumb-parent', 'My Money')

@section('content')
    @can('admin')
        <div class="alert alert-info">This page is for agents. Agents' accounts are on <a href="{{ route('accounts.index') }}">Cash &amp; Bank</a>.</div>
    @else
        <livewire:accounts.manage :mine="true" />
    @endcan
@endsection
