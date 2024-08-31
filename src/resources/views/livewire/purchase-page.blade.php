<div class="container">
    @if(count($items) > 0)
        <div class="search--results">
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
        </div>
    @else
        <div class="inner">
            <section class="content">
                <div class="content--item">
                    <div class="content--item__image">
                        @if ($item->item_image)
                            <img src="{{ asset('storage/images/' . basename($item->item_image)) }}" alt="">
                        @else
                            <img alt="">
                        @endif
                    </div>
                    <div class="content--item--detail">
                        <p class="content--item--name">{{$item->name}}</p>
                        <span class="content--item--price">￥{{$item->price}}</span>
                    </div>
                </div>

                <div class="edit">
                    <div class="edit__group">
                        <span class="edit--about">支払い方法</span>
                            <button class="edit--pay--button" type="button" wire:click="showPaymentOptions">変更する</button>
                        @if($showSelect)
                            <select wire:model="selectedPaymentMethod" wire:change="selectPaymentMethod($event.target.value)">
                                @foreach($paymentMethods as $paymentMethod)
                                    <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <span class="edit__current">{{ $paymentMethods->find($selectedPaymentMethod)->name ?? 'クレジットカード' }}</span>
                </div>

                <div class="edit">
                    <div class="edit__group">
                        <span class="edit--about">配送先</span>
                        <a class="edit--address--button" href="{{ route('address', ['itemId' => $item->id]) }}">変更する</a>
                    </div>
                    <span class="edit__current">{{ $postal_code ?? '未設定' }}</span>
                    <span class="edit__current">{{ $address ?? '未設定' }}</span>
                    <span class="edit__current">{{ $building ?? '未設定' }}</span>
                </div>
            </section>

            <section class="purchase">
                <div class="purchase__group">
                    <div class="purchase--price">
                        <span class="purchase__head">商品代金</span>
                        <span class="purchase--detail">￥{{$item->price}}</span>
                    </div>
                    <div class="purchase--payment">
                        <span class="purchase__head">支払い金額</span>
                        <span class="purchase--detail">￥{{$item->price}}</span>
                    </div>
                    <div class="purchase--method">
                        <span class="purchase__head">支払い方法</span>
                        <span class="purchase--detail">
                            @if($selectedPaymentMethod)
                                {{ $paymentMethods->find($selectedPaymentMethod)->name ?? '未設定' }}
                            @else
                                未設定
                            @endif
                        </span>
                    </div>
                </div>

                <form id="purchase-form" action="{{route('purchase.done')}}" method="post">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <input type="hidden" name="item_name" value="{{ $item->name }}">
                    <input type="hidden" name="payment_method_id" value="{{ $selectedPaymentMethod }}">
                    <input type="hidden" name="postal_code" value="{{ $postal_code }}">
                    <input type="hidden" name="address" value="{{ $address }}">
                    <input type="hidden" name="building" value="{{ $building }}">
                    <button class="purchase__button" type="submit">購入する</button>
                </form>
            </section>
        </div>
    @endif
</div>