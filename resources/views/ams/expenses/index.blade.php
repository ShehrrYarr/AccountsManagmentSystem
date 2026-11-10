@extends('layouts.app')

@section('title', 'Expenses')
@section('page-title', 'Expenses')
@section('breadcrumb-parent', 'Money Out')

@section('content')
    <livewire:expenses.manage />
@endsection
