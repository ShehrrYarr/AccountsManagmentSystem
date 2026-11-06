@extends('layouts.auth')
@section('title', 'Reset Password')
@section('content')
    <livewire:auth.reset-password :token="$token" />
@endsection
