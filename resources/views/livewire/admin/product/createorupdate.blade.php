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
    <form class="row">
        @csrf
        <h4 class="co-6 checkout__input mb-5 border-bottom"> {{ isset($isedit) ? 'Update Product' : 'New Product' }}</h4>
        <div class="col-12 form-row">
            <div class="col-6">
                <div class="checkout__input">
                    <p>Tên<span>*</span></p>
                    <input type="text" wire:model.defer="name">
                    <p class="error">
                        @error('name')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-6">
                <div class="checkout__input">
                    <p>Thể Loại<span>*</span></p>
                    <select type="text" wire:model.defer="category" id="category" class="select2-box">
                        <option value=''>Chọn loại thể loại</option>
                        @foreach ($listcategories as $key => $value)
                            <option value={{ $key }}>{{ $value }}</option>
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
                    <input type="text" wire:model.defer="importprice">
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
                    <input type="text" wire:model.defer="price">
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
                    <input type="text" wire:model.defer="quantity">
                    <p class="error">
                        @error('quantity')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 form-row">
            <div class="col-4">
                <div class="checkout__input">
                    <p>Nhãn Hàng<span>*</span></p>
                    <select type="text" wire:model.defer="brand" class="select2-box">
                        <option value=''>Chọn loại nhãn hàng</option>
                        @foreach ($brands as $key => $value)
                            <option value={{ $key }}>{{ $value }}</option>
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
                    <p>Mô Tả<span>*</span></p>
                    <textarea type="text" wire:model.defer="description" placeholder=""></textarea>
                    <p class="error">
                        @error('description')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="checkout__input">
                    <p> {{ isset($isedit) ? 'Thên Ảnh' : 'Ảnh' }}<span>*</span></p>
                    <input type="file" multiple wire:model.defer="photos">
                    <p class="error">
                        @error('photos')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 form-row">
            <div class="col-1">
                <div class="text-center">
                    <p style="margin-bottom: 0px !important;">Hiển Thị</p>
                    <input type="checkbox" wire:model.defer="status" placeholder="">
                </div>
            </div>
            <div class="col-1">
                <div class="text-center">
                    <p style="margin-bottom: 0px !important;">Nổi bật</p>
                    <input type="checkbox" wire:model.defer="trend" placeholder="">
                </div>
            </div>
        </div>

        <div class="form-group col-12 row justify-content-center btn-group-mto mt-5">
            <div>
                <a href="{{ route('admin.product.index') }}" class="btn btn-default">
                    <i class="fa fa-arrow-left"></i>
                    Trở lại
                </a>
                <button wire:click.prevent="store" type="button" class="btn btn-primary"><i class="fa fa-plus"></i>
                    {{ isset($isedit) ? 'Update' : 'Create' }}</button>

            </div>
        </div>
        @if ($isedit)
            <div class="col-12 form-row mt-5 mb-5">
                <div class="col-12">
                    <div class="w-100">
                        <h6 class="mb-4">Ảnh Sản Phẩm</h6>
                        <div class="d-flex flex-wrap">
                            @php
                                $index = 0;
                            @endphp
                            @foreach ($listimg as $item)
                                <div class="col-3">
                                    <li class="list-inline-item icon-trash"
                                        wire:click="removeImg({{ $item['id'] }},{{ $index++ }})">
                                        <button class="btn btn-danger btn-sm rounded-0" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                class="fa fa-trash"></i></button>
                                    </li>
                                    <img src='{{ asset('storage/product/' . $item['image_name']) }}' alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @elseif($photos)
            <div class="col-12 form-row mt-5 mb-5">
                <div class="col-12">
                    <div class="w-100">
                        <h6 class="mb-4">Ảnh Sản Phẩm</h6>
                        <div class="d-flex flex-wrap">
                            @php
                                $index = 0;
                            @endphp
                            @foreach ($listimg as $item)
                                <div class="col-3">
                                    @foreach ($photos as $item)
                                        <img src='{{ $item->temporaryUrl() }}' alt="">
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </form>
</div>
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            $('#category').select2()
            $('#category').on('change', function(e) {
                var data = $('#category').select2("val");
                @this.set('category', data);
            });
        });
    </script>
@endsection
