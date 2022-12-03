<div>
    @push('css')
        <style>
            .error>strong {
                color: red;
            }
        </style>

        <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
    @endpush
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Trang chủ</a>
                            <a href="./shop.html">Sản phẩm</a>
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
                            <h6 class="checkout__title">Chi tiết thông tin hóa đơn</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Tên<span>*</span></p>
                                        <input type="text" style="color:black !important;" wire:model="name">
                                        <p class="error">
                                            @error('name')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Quốc gia<span>*</span></p>
                                <input type="text" style="color:black !important;" wire:model.defer="country">
                                <p class="error">
                                    @error('country')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </p>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" style="color:black !important;" wire:model.defer="address"
                                    placeholder="Street Address" class="checkout__input__add">
                                <p class="error">
                                    @error('address')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </p>
                            </div>
                            <div class="checkout__input">
                                <p>Thành phố<span>*</span></p>
                                <input type="text" style="color:black !important;" wire:model="city">
                                <p class="error">
                                    @error('city')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </p>
                            </div>
                            <div class="checkout__input">
                                <p>Quận/Huyện<span>*</span></p>
                                <input type="text" style="color:black !important;" wire:model.defer="district">
                                <p class="error">
                                    @error('district')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="text" style="color:black !important;" wire:model.defer="phone">
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
                                        <input type="text" style="color:black !important;" wire:model.defer="email">
                                        <p class="error">
                                            @error('email')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú<span>*</span></p>
                                <input type="text" style="color:black !important;" wire:model.defer="note"
                                    placeholder="Notes about your order.">
                                <p class="error">
                                    @error('note')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Hóa đơn</h4>
                                <div class="checkout__order__products">Sản phẩn <span>Tổng tiền</span></div>
                                <ul class="checkout__total__products">
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach ($carts as $item)
                                        @php
                                            $price = $item['price'];
                                            if (count($item['discount'])) {
                                                if ($item['discount'][0]['unit'] == 1) {
                                                    $price = $item['price'] * (1 - $item['discount'][0]['percent'] / 100);
                                                } else {
                                                    $price = $item['price'] - $item['discount'][0]['percent'];
                                                }
                                            }
                                        @endphp
                                        <li>{{ ++$index }}. {{ $item['product_name'] }}
                                            <p>Giá:
                                                {{ number_format($price * $item['quantity'], 0, ',', ',') }}
                                                Đ | Số lượng:{{ $item['quantity'] }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="checkout__total__products">
                                    <h6 class="mb-3">Phiếu giảm giá</h6>
                                    <form>
                                        <select class="form-control use w-100" type="text"
                                            wire:change="applyDiscount" wire:model="discount">
                                            <option>--Chọn--</option>
                                            @foreach ($discounts as $item)
                                                <option value={{ $item['code'] }}>{{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <button type="submit" wire:click.prevent="addDiscount">Apply</button> --}}
                                    </form>
                                </div>
                                <ul class="checkout__total__all">
                                    <li>Tổng tiền sản phẩm <span>{{ number_format($totalPrice, 0, ',', ',') }}
                                            Đ</span></li>
                                    <li>Giảm giá <span>{{ number_format($discountprice, 0, ',', ',') }} Đ</span></li>
                                    <li>Phí vận chuyển <span>{{ number_format($ship, 0, ',', ',') }} Đ</span></li>
                                    <li>Tổng tiền hóa đơn
                                        <span>{{ number_format($totalPrice - $discountprice + $ship, 0, ',', ',') }}
                                            Đ</span>
                                    </li>
                                </ul>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Trả khi giao
                                        <input type="radio" wire:model="payment" id="payment" name="paymemt"
                                            value=1>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="radio" wire:model="payment" id="paypal" name="paymemt"
                                            value=2>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p class="error">
                                    @error('payment')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </p>
                                @if ($payment == 1)
                                    <button type="submit" class="site-btn">Tạo hóa đơn</button>
                                @else
                                    <div id="paypal-button-container"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        window.addEventListener('paypal', event => {
            paypal.Buttons({
                // Sets up the transaction when a payment button is clicked
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: {{ $totalPrice }} // Can also reference a variable or function
                            }
                        }]
                    });
                },
                // Finalize the transaction after payer approval
                onApprove: (data, actions) => {
                    return actions.order.capture().then(function(orderData) {
                        // Successful capture! For dev/demo purposes:
                        console.log('Capture result', orderData, JSON.stringify(orderData, null,
                            2));
                        const transaction = orderData.purchase_units[0].payments.captures[0];
                        alert('Thanhf coong rooif nhaf');
                        // When ready to go live, remove the alert and show a success message within this page. For example:
                        // const element = document.getElementById('paypal-button-container');
                        // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                        // Or go to another URL:  actions.redirect('thank_you.html');
                        window.livewire.emit('checkout');
                    });
                }
            }).render('#paypal-button-container');

        })
    </script>
</div>
