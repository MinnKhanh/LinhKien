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
    @php
        use App\Enums\Typediscount;
    @endphp
    <div wire:loading class="loader" style="z-index: 1"></div>
    <form class="row">
        @csrf
        <h4 class="co-6 checkout__input mb-5 border-bottom"> {{ isset($isedit) ? 'Update Discount' : 'New Discount' }}
        </h4>
        <div class="col-12 form-row">
            <div class="col-4">
                <div class="checkout__input">
                    <p>Loại<span>*</span></p>
                    <select wire:model="type">
                        @forelse (Typediscount::getValues() as $item)
                            <option value={{ $item }}>
                                {{ Typediscount::getTypesOfDiscount($item) }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                    <p class="error">
                        @error('type')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="checkout__input">
                    <p>Mã<span>*</span></p>
                    <input type="text" wire:model.defer="code">
                    <p class="error">
                        @error('code')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
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
        </div>
        <div class="col-12 form-row">
            <div class="col-4">
                <div class="checkout__input">
                    <p>Thời điểm bắt đầu<span>*</span></p>
                    <input type="date" wire:model.defer="begin">
                    <p class="error">
                        @error('begin')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="checkout__input">
                    <p>Thời điểm kêt thúc<span>*</span></p>
                    <input type="date" wire:model.defer="end">
                    <p class="error">
                        @error('end')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="checkout__input">
                    <p>Mô tả<span>*</span></p>
                    <textarea type="date" wire:model.defer="description"></textarea>
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
                    <p>Số tiền khuyến mãi<span>*</span></p>
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
                    <p>Đơn vị<span>*</span></p>
                    <select type="date" wire:model.defer="unit">
                        <option value=1>Theo %</option>
                        <option value=2>Theo nghìn đồng</option>
                    </select>
                    <p class="error">
                        @error('unit')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="checkout__input">
                    <p>Áp dụng<span>*</span></p>
                    <select wire:model.defer="apply">
                        <option value=1>Có</option>
                        <option value=0>Không</option>
                    </select>
                    <p class="error">
                        @error('apply')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 form-row">
            <div class="col-12">
                <div class="checkout__input">
                    <p>Sản phẩm<span>*</span></p>
                    <select class="form-control shadow-none rounded-0" wire:model.defer="product"
                        {{ $type != 2 ? 'disabled' : '' }}>
                        <option>--Chọn--</option>
                        @forelse ($products as $item)
                            <option value={{ $item['id'] }}>{{ $item['product_name'] }}</option>
                        @empty
                        @endforelse
                    </select>
                    <p class="error">
                        @error('product')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 form-row">
            <div class="col-6">
                <div class="checkout__input">
                    <p> {{ isset($isedit) ? 'Thên Ảnh' : 'Ảnh' }}<span>*</span></p>
                    <input type="file" wire:model.defer="photo">
                    <p class="error">
                        @error('photos')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-6 form-row">
                <div class="col-12 d-flex justify-content-center" style="height: 10rem">
                    <img src="{{ $photo ? $photo->temporaryUrl() : ($img ? asset('storage/discount/' . $img) : '') }}"
                        alt="">
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
