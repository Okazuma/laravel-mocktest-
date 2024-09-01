@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('logo')
@endsection

@section('search')
@endsection

@section('button')
@endsection

@section('content')
    <div class="container">
        <h1 class="title">商品の出品</h1>
        <form class="inner" action="{{route('item.sell')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="item-group">
                <span class="detail-title">商品画像</span>
                <div class="image-block">
                    <div class="file-upload">
                        <label for="file-upload" class="custom-file-upload">画像を選択する</label>
                        <input id="file-upload" type="file" name="item_image" value="">
                        @error('item_image')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="item-detail">
                <h2 class="item-title">商品の詳細</h2>
                <div class="full-width-line"></div>
                <div class="item-group">
                    <label class="detail-title" for="category_id">カテゴリー</label>
                    @livewire('multi-select')
                    @error('selectedCategories') <!-- バリデーションエラー表示 -->
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="item-group">
                    <label class="detail-title" for="condition">商品の状態</label>
                    <input class="detail-input" type="text" name="condition" id="condition" value="{{old('condition')}}">
                    @error('condition')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="item-description">
                <h2 class="item-title">商品名と説明</h2>
                <div class="full-width-line"></div>
                <div class="item-group">
                    <label class="detail-title" for="name">商品名</label>
                    <input class="detail-input" type="text" name="name" id="name" value="{{old('name')}}">
                    @error('name')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="item-group">
                    <label class="detail-title" for="description">商品の説明</label>
                    <textarea class="detail-text" type="text" name="description" id="description">{{old('description')}}</textarea>
                    @error('description')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="item-price">
                <h2 class="item-title">販売価格</h2>
                <label class="detail-title" for="price">販売価格</label>
                <input class="detail-input" type="number" name="price" id="price" value="{{old('price')}}" placeholder="￥">
                @error('price')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="sell__button" type="submit">出品する</button>
        </form>
    </div>
@endsection