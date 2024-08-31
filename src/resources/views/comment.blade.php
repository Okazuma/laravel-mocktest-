@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
@endsection

@section('content')
    <div class="session__alert">
        @if(session('message'))
            <div class="session__alert--success">
                {{session('message')}}
            </div>
        @endif
    </div>

    @livewire('comment-page',['itemId' => $item->id])

@endsection