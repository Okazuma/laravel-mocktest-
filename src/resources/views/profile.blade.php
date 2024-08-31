@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <div class="session__alert">
        @if(session('message'))
        <div class="session__alert--success">
        {{session('message')}}
        </div>
        @endif
    </div>

    @livewire('profile-page')

@endsection