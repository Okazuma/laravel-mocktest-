<div class="container">
    @if(count($items) > 0)
        <div class="items">
            @foreach($items as $item)
                <a class="item__image" href="{{route('detail', $item->id)}}">
                    @if ($item->item_image)
                        <img src="{{ asset('storage/images/' . basename($item->item_image)) }}" alt="">
                    @else
                        <img alt="">
                    @endif
                </a>
            @endforeach
        </div>
    @else
        <div class="content">
            <form class="" action="{{route('updateProfile',['id' => $user->id])}}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <h1 class="title">プロフィール設定</h1>
                <div class="header__heading">
                    <div class="profile__image">
                        @if ($user->profile_image)
                            
                            <img src="{{ Storage::disk('s3')->url($user->profile_image) }}" alt="">

                        @else
                            <img class="no-image">
                        @endif
                    </div>
                    <div class="file-upload">
                        <label for="file-upload" class="custom-file-upload">画像を選択する</label>
                        <input id="file-upload" type="file" name="profile_image" value="{{$user->profile_image}}">
                        @error('profile_image')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form__group">
                    <label class="form__title" for="name">ユーザー名</label>
                    <input class="form--input" type="text" name="name" id="name" value="{{$user->name}}" autocomplete="name">
                    @error('name')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form__group">
                    <label class="form-title" for="postal_code">郵便番号</label>
                    <input class="form--input" type="text" name="postal_code" id="postal_code" value="{{$user->postal_code}}" value="{{ old('postal_code') }}" autocomplete="postal_code">
                    @error('postal_code')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form__group">
                    <label class="form__title" for="address">住所</label>
                    <input class="form--input" type="text" name="address" id="address" value="{{$user->address}}" autocomplete="address">
                    @error('address')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form__group">
                    <label class="form__title" for="building">建物名</label>
                    <input class="form--input" type="text" name="building" id="building" value="{{$user->building}}" autocomplete="building">
                    @error('building')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form__group">
                    <button class="update__button" type="submit">更新する</button>
                </div>
            </form>
        </div>
    @endif
</div>
