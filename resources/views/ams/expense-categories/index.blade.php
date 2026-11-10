@extends('layouts.app')

@section('title', 'Expense Categories')
@section('page-title', 'Expense Categories')
@section('breadcrumb-parent', 'Setup')

@section('content')
    <livewire:master.simple-crud entity="expense-categories" />
@endsection
