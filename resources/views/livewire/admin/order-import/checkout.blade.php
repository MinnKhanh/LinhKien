    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .checkout__input select {
                height: 50px;
                width: 100%;
                border: 1px solid #e1e1e1;
                font-size: 14px;
                color: #b7b7b7;
                padding-left: 20px;
                margin-bottom: 20px;
                color: black;
            }

            .checkout__input textarea {
                height: 50px;
                width: 100%;
                border: 1px solid #e1e1e1;
                font-size: 14px;
                color: #b7b7b7;
                padding-left: 20px;
                margin-bottom: 20px;
                color: black;
            }

            .checkout__input input {
                color: black;
            }

            .error strong {
                color: red;
            }

            .icon-trash {
                position: absolute;
                left: 0px;
                top: 0px;
                margin: 0px;
                margin-left: 15px;
            }
        </style>
    @endpush
    <div class="container">
        <div class="row mt-5">
            <h4 class="co-6 checkout__input mb-5 border-bottom">Thông Tin Nhà Cung Cấp</h4>
            <div class="col-12 form-row">
                <div class="col-4">
                    <div class="checkout__input">
                        <p>Nhà Cung Cấp<span>*</span></p>
                        <select wire:model="vendor">
                            <option value=0>--Chọn Nhà Cung Cấp--</option>
                            @forelse ($vendors as $item)
                                <option value={{ $item['id'] }}>{{ $item['vendor_name'] }}</option>
                            @empty
                            @endforelse
                        </select>
                        <p class="error">
                            @error('description')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="checkout__input">
                        <p>Địa Chỉ<span>*</span></p>
                        <input type="text" wire:model.defer="address">
                        <p class="error">
                            @error('address')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="checkout__input">
                        <p>Số Điện Thoại<span>*</span></p>
                        <input type="text" wire:model.defer="phone">
                        <p class="error">
                            @error('phone')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 form-row">
                <div class="col-6">
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
                <div class="col-6">
                    <div class="checkout__input">
                        <p>Ghi Chú<span>*</span></p>
                        <textarea wire:model.defer="note" class="w-100"></textarea>
                        <p class="error">
                            @error('note')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-12 form-row">
                <div class="col-4 tex-center d-flex justify-content-start align-items-center">
                    <button wire:click.prevent="createOrder" type="button" class="btn btn-primary"><i
                            class="fa fa-plus"></i>
                        Tạo Hóa Đơn</button>

                </div>
            </div>
        </div>
    </div>
    <div class="shopping__cart__table mt-5 w-100">
        <h4 class="mb-5">Danh sách sản phẩm</h4>
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
                @forelse ($listproductimport as $key=> $item)
                    @php
                        $totalPrice += $item['price'] * $item['quantity'];
                    @endphp
                    <tr>
                        <td class="product__cart__item">
                            <div class="product__cart__item__pic">
                                <img style="height: 5rem;"
                                    src="{{ asset('storage/product/' . $item['productInfo']['img'][0]['image_name']) }}"
                                    alt="">
                            </div>
                            <div class="product__cart__item__text">
                                <h6>{{ $item['productInfo']['product_name'] }}</h6>
                                <h5>{{ number_format($item['importprice'], 0, ',', ',') }} Đ</h5>
                            </div>
                        </td>
                        <td class="quantity__item">
                            <div class="quantity">
                                <div class="">
                                    <input class="countproduct mr-3" data-id="{{ floatval($key) }}"
                                        value="{{ $item['quantity'] }}" type="number" min=0>
                                </div>
                            </div>
                        </td>
                        <td class="cart__price">
                            {{ number_format($item['importprice'] * $item['quantity'], 0, ',', ',') }} Đ</td>
                        <td class="cart__close"><i class="fa fa-close"></i></td>
                        {{-- wire:click="changeCart([{{ $item['id'] }},0])" --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Hiện chưa có sản phẩm nào</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    </div>
