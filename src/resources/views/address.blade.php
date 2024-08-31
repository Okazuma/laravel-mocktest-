@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('logo')
@endsection

@section('search')
@endsection

@section('button')
@endsection

@section('content')
    <div class="container">
        <form class="address__form" action="{{ route('updateAddress') }}" method="post">
        @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <h1 class="title">住所の変更</h1>
            <div class="form-group">
                <span class="form-title">郵便番号</span>
                <input class="form-input" name="postal_code" value="">
            </div>
            <div class="form-group">
                <span class="form-title">住所</span>
                <input class="form-input" type="text" name="address" value="">
            </div>
            <div class="form-group">
                <span class="form-title">建物名</span>
                <input class="form-input"  type="text" name="building" value="">
            </div>
            <div class="form-group">
                <button class="update__button" type="submit">更新する</button>
            </div>
        </form>
    </div>
@endsection
