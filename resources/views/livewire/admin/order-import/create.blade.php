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
    <div wire:loading class="loader" style="z-index: 1"></div>
    <div class="row">
        @csrf
        <h4 class="co-6 checkout__input mb-5 border-bottom">Nhập Hàng</h4>
        <div class="col-12 form-row">
            <div class="col-4">
                <div class="checkout__input">
                    <p>Thể Loại<span>*</span></p>
                    <select wire:change="change" wire:model="category" id="">
                        <option value=0>--Chọn Nhà Thể Loại--</option>
                        @forelse ($listCategories as $item)
                            <option value={{ $item['id'] }}>{{ $item['category_name'] }}</option>
                        @empty
                        @endforelse
                    </select>
                    <p class="error">
                        @error('name')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>

            <div class="col-4">
                <div class="checkout__input">
                    <p>Nhãn Hàng<span>*</span></p>
                    <select type="text" wire:change="change" wire:model.defer="brand" class="select2-box">
                        <option value=0>--Chọn Nhà Nhãn Hàng--</option>
                        @foreach ($brands as $value)
                            <option value={{ $value['id'] }}>{{ $value['brand_name'] }}</option>
                        @endforeach
                    </select>
                    <p class="error">
                        @error('brand')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="checkout__input">
                    <p>Sản Phẩm<span>*</span></p>
                    <select type="text" wire:model="product" id="category" class="select2-box">
                        <option value=''>--Chọn Sản Phẩm--</option>
                        @foreach ($listProducts as $value)
                            <option value={{ $value['id'] }}>{{ $value['product_name'] }}</option>
                        @endforeach
                    </select>
                    <p class="error">
                        @error('category')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 form-row">
            <div class="col-4">
                <div class="checkout__input">
                    <p>Giá Nhập<span>*</span></p>
                    <input type="number" wire:model.defer="importprice">
                    <p class="error">
                        @error('importprice')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="checkout__input">
                    <p>Giá Bán<span>*</span></p>
                    <input type="number" wire:model.defer="price">
                    <p class="error">
                        @error('price')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="checkout__input">
                    <p>Số Lượng<span>*</span></p>
                    <input type="number" wire:model.defer="quantity" min="0">
                    <p class="error">
                        @error('quantity')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
        </div>
        {{-- <div class="col-12 form-row">
            <div class="col-4">
                <div class="checkout__input">
                    <p>Nhà Cung Cấp<span>*</span></p>
                    <select wire:model.defer="vendor">
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
                    <select wire:model.defer="vendor">
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
                    <p>Số Điện Thoại<span>*</span></p>
                    <select wire:model.defer="vendor">
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
        </div>
        <div class="col-12 form-row">
            <div class="col-4">
                <div class="checkout__input">
                    <p>Email<span>*</span></p>
                    <select wire:model.defer="vendor">
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
                    <p>Ghi Chú<span>*</span></p>
                    <select wire:model.defer="vendor">
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
            <div class="col-4 tex-center d-flex justify-content-start align-items-center">
                <button wire:click.prevent="store" type="button" class="ml-5 btn btn-primary"><i
                        class="fa fa-plus"></i>Thêm</button>

            </div>
        </div> --}}
        <div class="col-12 form-row">
            <div class="col-4 tex-center d-flex justify-content-start align-items-center">
                <button wire:click="addProduct" type="button" class="btn btn-primary"><i
                        class="fa fa-plus"></i>Thêm</button>

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
                                    <input class="quantityproduct mr-3 chay" data-id="{{ floatval($key) }}"
                                        value="{{ $item['quantity'] }}" type="number" min=0>
                                </div>
                            </div>
                        </td>
                        <td class="cart__price">
                            {{ number_format($item['importprice'] * $item['quantity'], 0, ',', ',') }} Đ</td>
                        <td class="cart__close"><i class="fa fa-close"
                                wire:click="removeFromCart({{ $key }})"></i></td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Hiện chưa có sản phẩm nào</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    <div class="col-4 tex-center d-flex justify-content-start align-items-center">
        <a href="{{ route('admin.orderimport.checkout') }}" type="button"
            class="btn btn-primary {{ $listproductimport ? '' : 'd-none' }}"><i class="fa fa-plus"></i>Tạo hóa
            đơn</a>

    </div>
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('change', '.quantityproduct', function(event) {
                let value = $(this).parent().find('.quantityproduct').val();
                let id = $(this).parent().find('.quantityproduct').attr('data-id')
                if (value < 0) {
                    $(this).parent().find('.quantityproduct').val(0);
                }
                window.livewire.emit('changeCart', {
                    0: id,
                    1: value
                });
            })
        })
    </script>
@endpush
