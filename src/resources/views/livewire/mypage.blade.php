<div class="container">
    @if(count($items) > 0)
        <div class="search-results">
            <div class="items">
                @foreach($items as $item)
                    <a class="item__image" href="{{route('detail', $item->id)}}">
                        @if ($item->item_image)
                            <img src="{{ asset('storage/' . $item->item_image) }}" alt="">
                        @else
                            <img alt="">
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    @else
    <div class="profile">
        <div class="profile__image">
            @if ($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="">
            @else
                <img class="">
            @endif
        </div>
        <p class="user-name">{{ $user->name }}</p>
        <a class="edit__button" href="{{route('profile',['id' => Auth::user()->id])}}">プロフィールを編集</a>
    </div>
        @livewire('user-products')
    @endif
</div>
