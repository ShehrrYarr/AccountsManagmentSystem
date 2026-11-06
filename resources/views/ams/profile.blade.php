@extends('layouts.app')

@section('title', 'My Profile')
@section('page-title', 'My Profile')
@section('breadcrumb-parent', 'Account')

@section('content')
    <livewire:users.profile />
@endsection
