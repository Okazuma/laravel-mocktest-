@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="session__alert">
        @if(session('message'))
            <div class="session__alert--success">
        {{session('message')}}
            </div>
        @endif
    </div>

    @can('manage users')
        <div class="admin">
            <a class="admin__button" href="{{ route('dashboard') }}">管理画面</a>
        </div>
    @endcan


    @livewire('products')

@endsection