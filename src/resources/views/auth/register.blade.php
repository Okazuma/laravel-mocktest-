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

        <div class="form-group">
            <span class="form-title">メールアドレス</span>
            <input class="form-input" type="text" name="email" value="{{ old('email') }}" autocomplete="email">
        </div>

        <div class="form-group">
            <span class="form-title">パスワード</span>
            <input class="form-input" type="text" name="password" value="" autocomplete="password">
        </div>

        <div class="form-group">
            <button class="register__button" type="submit">登録する</button>
        </div>
    
    </form>

    <a class="login__button" href="{{route('loginView')}}">ログインはこちら</a>

</div>
@endsection