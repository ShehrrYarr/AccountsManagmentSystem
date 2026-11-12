@extends('layouts.app')

@section('title', 'Deposit Cheque')
@section('page-title', 'Deposit Cheque')
@section('breadcrumb-parent')<a href="{{ route('cheques.index') }}">Govt Cheques</a>@endsection

@section('page-actions')
    <a href="{{ route('cheques.index') }}" class="btn btn-sm btn-light">
        <i class="ri-arrow-left-line me-1"></i>All cheques
    </a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-xxl-9 col-xl-10">
            <livewire:cheques.register-cheque :as-page="true" :company="request()->query('company')" :department="request()->query('department')" />
        </div>
    </div>
@endsection
