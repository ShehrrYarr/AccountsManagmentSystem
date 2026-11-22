@extends('layouts.app')

@section('title', $tax->name)
@section('page-title', $tax->name)
@section('breadcrumb-parent')
    <a href="{{ route('taxes.index') }}">Taxes</a>
@endsection

@section('content')
    <livewire:taxes.payments :tax-id="$tax->id" />
@endsection
