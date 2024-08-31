@extends('layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/delete-comment.css') }}">
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
        <h1 class="delete__title">コメント管理</h1>
        <table class="delete__content">
            <thead class="delete__head">
                <tr class="table__row">
                    <th class="table__head--date">作成日時</th>
                    <th class="table__head--comment">コメント内容</th>
                    <th class="table__head--delete">削除</th>
                </tr>
            </thead>

            <tbody class="delete__body">
                @foreach($comments as $comment)
                    <tr class="table__row">
                        <td class="table__desc--date">{{ $comment->created_at }}</td>
                        <td class="table__desc--comment">{{ $comment->content }}</td>
                        <td class="table__desc--delete">
                            <form action="{{ route('comments.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <button type="submit" class="delete__button" onclick="return confirm('本当に削除しますか？');">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        <table>

        <a class="back__button" href="{{route('dashboard')}}">戻る</a>
    </div>
@endsection