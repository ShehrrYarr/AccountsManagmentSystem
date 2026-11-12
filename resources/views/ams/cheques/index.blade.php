@extends('layouts.app')

@section('title', 'Govt Cheques')
@section('page-title', 'Govt Cheques')
@section('breadcrumb-parent', 'Money In')

@section('page-actions')
    <button type="button" class="btn btn-sm btn-primary" x-data x-on:click="Livewire.dispatch('cheque-create')">
        <i class="ri-add-line me-1"></i>Deposit Cheque
    </button>
    <a href="{{ route('cheques.create') }}" class="btn btn-sm btn-outline-primary" title="Open the deposit form as a full page">
        <i class="ri-file-list-3-line me-1"></i>Deposit form page
    </a>
@endsection

@section('content')
    <livewire:cheques.list />

    <livewire:cheques.register-cheque />
@endsection
