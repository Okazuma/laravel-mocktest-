@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
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

    <h1 class="title">会員登録</h1>

    <form class="register__form" action="{{route('register')}}" method="post">
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
            <button class="register__button" type="submit">登録する</button>
        </div>
    </form>

    <a class="login__button" href="{{route('loginView')}}">ログインはこちら</a>

</div>
@endsection