@extends('layouts.app')

@section('title', 'Approvals')
@section('page-title', 'Approvals')
@section('breadcrumb-parent', 'Overview')

@section('content')
    <livewire:approvals.manage />
@endsection
