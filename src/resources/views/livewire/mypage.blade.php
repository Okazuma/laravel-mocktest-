<div class="container">
    @if(count($items) > 0)
        <div class="search-results">
            <div class="items">
                @foreach($items as $item)
                    <a class="item__image" href="{{route('detail', $item->id)}}">
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
        </div>
    @else
    <div class="profile">
        <div class="profile__image">
            @if ($user->profile_image)
                @if (config('filesystems.default') === 's3')
                    <img src="{{ Storage::disk('s3')->url($user->profile_image) }}" alt="No image">
                @else
                    <img src="{{ asset('storage/profile' . $user->profile_image) }}" alt="No image">
                @endif
            @else
                <img src="">
            @endif
        </div>
        <p class="user-name">{{ $user->name }}</p>
        <a class="edit__button" href="{{route('profile',['id' => Auth::user()->id])}}">プロフィールを編集</a>
    </div>
        @livewire('user-products')
    @endif
</div>