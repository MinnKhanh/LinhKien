@push('css')
    <style>
        .countproduct {
            width: 6rem;
            text-align: center;
        }
    </style>
@endpush
<div>
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @forelse ($carts as $item)
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img style="height: 5rem;"
                                                    src="{{ asset('storage/product/' . $item['img'][0]['image_name']) }}"
                                                    alt="">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6>{{ $item['product_name'] }}</h6>
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
                                                <h5>{{ number_format($price, 0, ',', ',') }} Đ</h5>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <div class="">
                                                    <input class="countproduct" data-id="{{ floatval($item['id']) }}"
                                                        value="{{ $item['quantity'] }}" type="number" min=0
                                                        max={{ $data[$item['id']] + $item['amount'] }}>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart__price">
                                            {{ number_format($price * $item['quantity'], 0, ',', ',') }} Đ</td>
                                        <td class="cart__close"><i class="fa fa-close"
                                                wire:click="changeCart([{{ $item['id'] }},0])"></i></td>
                                    </tr>
                                    @php
                                        $totalPrice += $price * $item['quantity'];
                                    @endphp
                                @empty
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('shop.index') }}">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    {{-- <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form>
                            <input type="text" wire:model.defer="discountcode" placeholder="Coupon code">
                            <button type="submit" wire:click.prevent="addDiscount">Apply</button>
                        </form>
                    </div> --}}
                    <div class="cart__total mt-5">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Total <span>{{ number_format($totalPrice, 0, ',', ',') }} Đ</span>
                            </li>
                        </ul>
                        <button class="primary-btn" type="button" wire:click="checkout"
                            style="color:white;width: 100%;">Proceed
                            to checkout</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.countproduct').change(function(event) {
                event.preventDefault()
                let value = $(this).parent().find('.countproduct').val();
                let id = $(this).parent().find('.countproduct').attr('data-id')
                if (value > parseInt($(this).parent().find('.countproduct').attr('max'))) {
                    $(this).parent().find('.countproduct').val(parseInt($(this).parent().find(
                        '.countproduct').attr('max')));
                }
                if (value < 0) {
                    $(this).parent().find('.countproduct').val(0);
                }
                window.livewire.emit('changeCart', {
                    0: id,
                    1: value
                });
            })
        })
    </script>
</div>
