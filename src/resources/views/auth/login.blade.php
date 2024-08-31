@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection


@section('search')
@endsection

@section('content')

<div class="session__alert">
    @if(session('message'))
    <div class="session__alert--success">
    {{session('message')}}
    </div>
    @endif
</div>

<div class="container">


    <h1 class="title">ログイン</h1>

    <form class="login__form" action="{{route('login')}}" method="post">
    @csrf
        <div class="form__group">
            <span class="form__title">メールアドレス</span>
            <input class="form--input" type="text" name="email" value="{{ old('email') }}" autocomplete="email">
            @error('email')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form__group">
            <span class="form__title">パスワード</span>
            <input class="form--input" type="text" name="password" value="" autocomplete="password">
            @error('password')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form__group">
            <button class="login__button" type="submit">ログインする</button>
        </div>
    </form>

    <a class="register__button" href="{{route('registerView')}}">会員登録はこちら</a>
</div>
@endsection