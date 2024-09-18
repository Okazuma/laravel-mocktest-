@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection



@section('content')

@if (session('error'))
    <div class="alert">
        {{ session('error') }}
    </div>
@endif

    @livewire('detail-page', ['itemId' => $item->id])

@endsection