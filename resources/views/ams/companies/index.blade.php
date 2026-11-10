@extends('layouts.app')

@section('title', 'Companies')
@section('page-title', 'Companies')
@section('breadcrumb-parent', 'Ledgers')

@section('content')
    <livewire:companies.list />
@endsection
