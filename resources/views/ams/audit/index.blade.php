@extends('layouts.app')

@section('title', 'Audit Log')
@section('page-title', 'Audit Log')
@section('breadcrumb-parent', 'Administration')

@section('content')
    <livewire:audit.log />
@endsection
