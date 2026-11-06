@extends('layouts.app')

@section('title', 'Companies')
@section('page-title', 'Companies')
@section('breadcrumb-parent', 'Master Data')

@section('content')
    <livewire:companies.list />
    <livewire:companies.bank-accounts />
@endsection
