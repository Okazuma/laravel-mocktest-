@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')

    @livewire('purchase-page',['itemId' => $item->id])

@endsection