@extends('layouts.app')

@section('title', 'Users')
@section('page-title', 'Users')
@section('breadcrumb-parent', 'Administration')

@section('content')
    <livewire:users.manage />
@endsection
