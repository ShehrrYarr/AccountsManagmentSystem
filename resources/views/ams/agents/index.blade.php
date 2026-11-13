@extends('layouts.app')

@section('title', 'Agents')
@section('page-title', 'Agents')
@section('breadcrumb-parent', 'Ledgers')

@section('content')
    <livewire:agents.list />
    <livewire:transfers.manage :modal-only="true" />
@endsection
