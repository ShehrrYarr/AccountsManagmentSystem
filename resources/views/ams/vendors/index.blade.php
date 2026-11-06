@extends('layouts.app')

@section('title', 'Vendors')
@section('page-title', 'Vendors')
@section('breadcrumb-parent', 'Master Data')

@section('content')
    <livewire:master.simple-crud entity="vendors" />
@endsection
