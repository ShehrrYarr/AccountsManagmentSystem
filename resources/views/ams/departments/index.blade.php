@extends('layouts.app')

@section('title', 'Departments')
@section('page-title', 'Departments')
@section('breadcrumb-parent', 'Ledgers')

@section('content')
    <livewire:departments.list />
    <livewire:departments.close-deal />
@endsection
