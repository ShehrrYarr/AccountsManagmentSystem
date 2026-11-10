@extends('layouts.app')

@section('title', 'Transaction Journal')
@section('page-title', 'Transaction Journal')
@section('breadcrumb-parent', 'Ledgers')

@section('content')
    <livewire:transactions.datatable />
@endsection
