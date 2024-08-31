<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>coachtechフリマ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="..." crossorigin="anonymous" />
    <script src="https://js.stripe.com/v3/"></script>

    @yield('css')
    @livewireStyles
</head>
<body>
    <header class="header">
        <div class="header__inner">
            @section('logo')
                <a class="header--logo" href="/"><img src="{{ asset('images/logo.svg') }}" alt=""></a>
            @show

            @section('search')
                @livewire('item-search')
            @show

            @section('button')
            <nav class="header__items">
                @auth
                <form class="" action="/logout" method="post" >
                    @csrf
                    <button class="logout__button" type="submit">ログアウト</button>
                </form>
                <a class="auth__button" href="{{route('mypage')}}">マイページ</a>
                @else
                <a class="auth__button" href="{{route('loginView')}}">ログイン</a>
                <a class="auth__button" href="{{route('registerView')}}">会員登録</a>
                @endauth
                <form class="" action="{{route('sell')}}" method="get">
                    @csrf
                    <button class="sell__button" type="submit">出品</button>
                </form>
            </nav>
            @show
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    @livewireScripts
</body>
</html>
