@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/checkout-cancel.css') }}">
@endsection

@section('logo')
@endsection

@section('search')
@endsection

@section('button')
@endsection

@section('content')

    <div class="container">
        <h1 class="title">決済が失敗しました。</h1>
        <a class="back__button" href="{{route('index')}}">TOP</a>
    </div>

@endsection