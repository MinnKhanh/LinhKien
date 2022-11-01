<div>
    @push('css')
        <style>
            .error>strong {
                color: red;
            }
        </style>
    @endpush
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form wire:submit.prevent="submit">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            {{-- <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a
                                    href="#">Click
                                    here</a> to enter your code</h6> --}}
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Name<span>*</span></p>
                                        <input type="text" wire:model.defer="name">
                                        <p class="error">
                                            @error('name')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" wire:model.defer="country">
                                <p class="error">
                                    @error('country')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </p>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" wire:model.defer="address" placeholder="Street Address"
                                    class="checkout__input__add">
                                <p class="error">
                                    @error('address')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </p>
                            </div>
                            <div class="checkout__input">
                                <p>City<span>*</span></p>
                                <input type="text" wire:model.defer="city">
                                <p class="error">
                                    @error('city')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </p>
                            </div>
                            <div class="checkout__input">
                                <p>District<span>*</span></p>
                                <input type="text" wire:model.defer="district">
                                <p class="error">
                                    @error('district')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" wire:model.defer="phone">
                                        <p class="error">
                                            @error('phone')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" wire:model.defer="email">
                                        <p class="error">
                                            @error('email')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text" wire:model.defer="note" placeholder="Notes about your order.">
                                <p class="error">
                                    @error('note')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                <ul class="checkout__total__products">
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach ($carts as $item)
                                        <li>{{ ++$index }}. {{ $item['product_name'] }}
                                            <p>Giá:
                                                {{ number_format($item['price'] * $item['quantity'], 0, ',', ',') }}
                                                Đ | Số lượng:{{ $item['quantity'] }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>{{ number_format($totalPrice, 0, ',', ',') }} Đ</span></li>
                                    <li>Discount <span>{{ number_format($discountprice, 0, ',', ',') }} Đ</span></li>
                                    <li>Total <span>{{ number_format($totalPrice - $discountprice, 0, ',', ',') }}
                                            Đ</span></li>
                                </ul>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="radio" wire:model.defer="payment" id="payment" name="paymemt"
                                            value=1>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="radio" wire:model.defer="payment" id="paypal" name="paymemt"
                                            value=2>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p class="error">
                                    @error('payment')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </p>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
