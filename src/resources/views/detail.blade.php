@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

    @livewire('detail-page', ['itemId' => $item->id])

@endsection