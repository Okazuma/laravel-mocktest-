<div class="container">
    @if(count($items) > 0)
        <div class="search--results">
            @foreach($items as $item)
                <a class="search__image" href="{{route('detail', $item->id)}}">
                    @if ($item->item_image)
                        <img src="{{ Storage::disk('s3')->url('images/' . basename($item->item_image)) }}" alt="">
                    @else
                        <img alt="">
                    @endif
                </a>
            @endforeach
        </div>
    @else
        <div class="inner">
            <div class="images">
                <div class="item__image">
                    @if ($item->item_image)
                            <img src="{{ Storage::disk('s3')->url($item->item_image) }}" alt="Item Image">
                        @else
                            <img alt="">
                        @endif
                </div>
            </div>

            <section class="detail">
                <h2 class="item__name">{{$itemDetails->name}}</h2>
                <span class="item__name__text">ブランド名</span>
                <div class="price">
                    <span class="item--price">￥</span>
                    <span class="item--price">{{$itemDetails->price}}</span>
                    <span class="item--price">(値段)</span>
                </div>

                <div class="icons">
                    @livewire('like-button', ['itemId' => $itemDetails->id])
                    <div class="comment">
                        <button class="comment__button" onclick="window.location.href='{{ route('comment', $item->id) }}'">
                            <i class="fa-regular fa-comment"></i>
                        </button>
                        <span class="comment--count">{{ $commentCount }}</span>
                    </div>
                </div>

                <a class="purchase__button" href="{{route('purchase',$item->id)}}">購入する</a>
                <h2 class="item__title">商品説明</h2>
                <span class="detail__description">{{$itemDetails->description}}</span>

                <h2 class="item__title">商品の情報</h2>
                <div class="item--about">
                    <span class="detail__title">カテゴリー:</span>
                    <span class="detail__category">
                        @foreach($itemDetails->categories as $category)
                        {{ $category->category }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                    </span>
                </div>

                <div class="item--about">
                    <span class="detail__title">商品の状態:</span>
                    <span class="detail__condition">{{$item->condition}}</span>
                </div>
            </section>
        </div>
    @endif
</div>