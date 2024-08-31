@extends('layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/send-notification.css') }}">
@endsection

@section('content')

    @if(session('success'))
        <div class="session__alert--success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <h1 class="notification__title">お知らせメール</h1>
        <form class="notification__content" action="{{ route('admin.send') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form__label" for="subject">件名 :</label>
                <input class="form--input" type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}" required>
            </div>
            <div class="form-group">
                <label class="form__label" for="message">内容 :</label>
                <textarea class="form--textarea" name="message" id="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
            </div>
            <button class="submit__button" type="submit">送信</button>
        </form>
        <a class="back__button" href="{{route('dashboard')}}">戻る</a>
    </div>
@endsection