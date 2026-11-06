@extends('layouts.app')

@section('title', 'My Accounts')
@section('page-title', 'My Accounts')
@section('breadcrumb-parent', 'Master Data')

@section('content')
    <livewire:bank-accounts.manage />
@endsection
