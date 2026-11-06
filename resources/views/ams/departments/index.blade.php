@extends('layouts.app')

@section('title', 'Government Departments')
@section('page-title', 'Government Departments')
@section('breadcrumb-parent', 'Master Data')

@section('content')
    <livewire:master.simple-crud entity="departments" />
@endsection
