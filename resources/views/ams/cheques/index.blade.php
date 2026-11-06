@extends('layouts.app')

@section('title', 'Government Cheques')
@section('page-title', 'Government Cheques')
@section('breadcrumb-parent', 'Cash In')

@section('page-actions')
    <button type="button" class="btn btn-sm btn-primary" x-data x-on:click="Livewire.dispatch('cheque-create')">
        <i class="ri-add-line me-1"></i>Receive Cheque
    </button>
@endsection

@section('content')
    <livewire:cheques.list />

    <livewire:cheques.register-cheque />
    <livewire:cheques.clear-cheque />
    <livewire:cheques.close-cheque />
@endsection
