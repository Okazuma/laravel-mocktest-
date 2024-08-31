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

        <div class="form-group">
            <span class="form-title">メールアドレス</span>
            <input class="form-input" type="text" name="email" value="{{ old('email') }}" autocomplete="email">
        </div>

    <div class="form-group">
        <span class="form-title">パスワード</span>
        <input class="form-input" type="text" name="password" value="" autocomplete="password">
    </div>

        <div class="form-group">
    <button class="login__button" type="submit">ログインする</button>
        </div>

</form>

<a class="register__button" href="{{route('registerView')}}">会員登録はこちら</a>

</div>
@endsection