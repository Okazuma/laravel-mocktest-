@extends('layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/delete-user.css') }}">
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
        <h1 class="delete__title">ユーザー管理</h1>
        <table class="delete__content">
            <thead class="delete__head">
                <tr class="table__row">
                    <th class="table__head--user">ユーザー</th>
                    <th class="table__head--delete">削除</th>
                </tr>
            </thead>

            <tbody class="delete__body">
                @foreach($users as $user)
                    <tr class="table__row">
                        <td class="table__desc--user">{{ $user->name }}</td>
                        <td class="table__desc--delete">
                            <form action="{{ route('users.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <button class="delete__button" type="submit" onclick="return confirm('本当に削除しますか？');">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        <table>

        <a class="back__button" href="{{route('dashboard')}}">戻る</a>
    </div>
@endsection