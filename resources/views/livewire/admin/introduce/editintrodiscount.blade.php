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
                    <p>Khuyến mãi<span>*</span></p>
                    <select wire:model.defer="discount">
                        <option>--Chọn--</option>
                        @forelse ($discounts as $item)
                            <option value={{ $item['id'] }}>
                                {{ $item['name'] }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                    <p class="error">
                        @error('discount')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="checkout__input">
                    <p>Tiêu đề<span>*</span></p>
                    <input type="text" wire:model.defer="title">
                    <p class="error">
                        @error('title')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="checkout__input">
                    <p>Mô tả<span>*</span></p>
                    <textarea wire:model.defer="description">
                    </textarea>
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
                    <p>Link<span>*</span></p>
                    <input type="text" wire:model.defer="link">
                    <p class="error">
                        @error('link')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
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
            <div class="col-4 form-row">
                <div class="col-12 d-flex justify-content-center" style="height: 10rem">
                    <img src="{{ $photo ? $photo->temporaryUrl() : ($img ? asset('storage/introduce/' . $img) : '') }}"
                        alt="">
                </div>
            </div>
        </div>
        <div class="col-12 form-row">
            <div class="col-4">
                <div class="checkout__input">
                    <p>Sử dụng<span>*</span></p>
                    <select wire:model.defer="active">
                        <option value=0>Có</option>
                        <option value=1>Không</option>
                    </select>
                    <p class="error">
                        @error('active')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
        </div>
        <div class="form-group col-12 row justify-content-center btn-group-mto">
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

        });
    </script>
@endsection
