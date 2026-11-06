@extends('layouts.app')

@section('title', 'Approvals')
@section('page-title', 'Approvals')
@section('breadcrumb-parent', 'Ledger')

@section('content')
    <livewire:approvals.queue />
@endsection
