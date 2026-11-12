@extends('layouts.app')

@section('title', 'Users & Agents')
@section('page-title', 'Users & Agents')
@section('breadcrumb-parent', 'Administration')

@section('content')
    <livewire:users.manage />
@endsection
