<div class="container">
    <div class="button-group">
        <button wire:click="showNew" class="{{ $viewType === 'new' ? 'active' : '' }}">おすすめ</button>
        <button wire:click="showLiked" class="{{ $viewType === 'liked' ? 'active' : '' }}">マイリスト</button>
    </div>

    <div class="full-width-line"></div>

    <div class="inner">
        @if($message)
            <p class="alert alert-info">{{ $message }}</p>
        @else
            <div class="items">
                @if(!empty($searchTerm))
                    @if($newItems->isEmpty())
                        <p>検索結果が見つかりませんでした。</p>
                    @else
                        <div class="items">
                            @foreach($newItems as $item)
                                <a class="item__image" href="{{ route('detail', $item->id) }}">
                                    @if ($item->item_image)
                                        @if (config('filesystems.default') === 's3')
                                            <img src="{{ Storage::disk('s3')->url($item->item_image) }}" alt="No image">
                                        @else
                                            <img src="{{ asset('storage/' . $item->item_image) }}" alt="No image">
                                        @endif
                                    @else
                                        <img src="" alt="No image">
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                @elseif($viewType === 'new')
                    @if($newItems->isEmpty())
                        <div class=""></div>
                    @else
                        <div class="items">
                            @foreach($newItems as $item)
                                <a class="item__image" href="{{route('detail', $item->id)}}">
                                    @if ($item->item_image)
                                        @if (config('filesystems.default') === 's3')
                                            <img src="{{ Storage::disk('s3')->url($item->item_image) }}" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $item->item_image) }}" alt="No image">
                                        @endif
                                    @else
                                        <img src="" alt="No image">
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                @else
                    @if($likedItems->isEmpty())
                        <p>まだいいねした商品はありません。</p>
                    @else
                        <div class="items">
                            @foreach($likedItems as $item)
                                <a class="item__image" href="{{route('detail', $item->id)}}">
                                    @if ($item->item_image)
                                        <img src="{{ asset('storage/' . $item->item_image) }}" alt="">
                                    @else
                                        <img src="">
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>
        @endif
    </div>
</div>