<div class="container">
    @if(count($items) > 0)
        <div class="search-results">
            <div class="items">
                @foreach($items as $item)
                    <a class="item__image" href="{{route('detail', $item->id)}}">
                        @if ($item->item_image)
                            <img src="{{ Storage::disk('s3')->url($item->item_image) }}" alt="Item Image">
                        @else
                            <img alt="">
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <div class="inner">
            <div class="images">
                <div class="images__item">
                    @if ($item->item_image)
                            <img src="{{ Storage::disk('s3')->url($item->item_image) }}" alt="Item Image">
                        @else
                            <img alt="">
                        @endif
                </div>
            </div>

            <div class="detail">
                <h2 class="item__name">{{$item->name}}</h2>
                <span class="item-name-text">ブランド名</span>

                <div class="price">
                    <span class="item--price">￥</span>
                    <span class="item--price">{{$item->price}}</span>
                    <span class="item--price">(値段)</span>
                </div>

                <div class="icons">
                    @livewire('like-button', ['itemId' => $item->id])
                    <div class="comment">
                        <button class="comment__button" onclick="window.location.href='{{ route('comment', $item->id) }}'">
                            <i class="fa-regular fa-comment"></i>
                        </button>
                        <span class="comment--count">{{ $commentCount }}</span>
                    </div>
                </div>
                @if($comments->isEmpty())
                    <p>まだコメントがありません。</p>
                @else
                    @foreach($comments as $comment)
                        @php
                            $isOwnComment = $comment->user_id === auth()->id();
                        @endphp
                        <div class="comments--user {{ $isOwnComment ? 'own-comment' : '' }}">
                            <div class="profile__image">
                                @if($comment->user->profile_image)
                                    <img src="{{ Storage::disk('s3')->url($user->profile_image) }}" alt="">
                                @else
                                    <img alt="">
                                @endif
                            </div>
                            <span class="comment--user">{{ $comment->user->name }}</span>
                            @if($isOwnComment)
                            <form class="delete--comment" action="{{ route('comment.destroy', $comment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="delete--comment--button" onclick="return confirm('コメントを削除しますか？');">&#10005;
                                </button>
                            </form>
                            @endif
                        </div>

                        <div class="comments__content {{ $isOwnComment ? 'own-comment-content' : '' }}">
                            <span class="comments__detail">{{ $comment->content }}</span>
                        </div>
                    @endforeach
                        <div class="pagination">
                            {{ $comments->links() }}
                        </div>
                @endif
                <form class="" action="{{route('store.comment',$item->id)}}" method="post">
                    @csrf
                    <textarea class="comment__form" name="content" placeholder=""></textarea>
                    @error('content')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                    <button class="submit__button" type="submit">コメントを送信する</button>
                </form>
            </div>
        </div>
    @endif
</div>
