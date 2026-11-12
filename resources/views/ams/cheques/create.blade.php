@extends('layouts.app')

@section('title', 'Deposit Cheques')
@section('page-title', 'Deposit Cheques')
@section('breadcrumb-parent')<a href="{{ route('cheques.index') }}">Govt Cheques</a>@endsection

@section('page-actions')
    <a href="{{ route('cheques.index') }}" class="btn btn-sm btn-light">
        <i class="ri-arrow-left-line me-1"></i>All cheques
    </a>
@endsection

@section('content')
    <livewire:cheques.register-cheque :as-page="true" :company="request()->query('company')" :department="request()->query('department')" />
@endsection
