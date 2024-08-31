@extends('layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1 class="admin__title">管理画面</h1>
        <div class="admin__content">
            <a class="admin__button" href="{{route('admin.user')}}">ユーザー管理</a>
            <a class="admin__button" href="{{route('admin.comment')}}">コメント管理</a>
            <a class="admin__button" href="{{route('admin.mail')}}">お知らせメール送信</a>
        </div>

        <a class="back__button" href="{{route('index')}}">TOP</a>
    </div>
@endsection