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
            <div class="col-6">
                <div class="checkout__input">
                    <p>Vị trí<span>*</span></p>
                    <input type="number" wire:model="index">
                    <p class="error">
                        @error('index')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-6">
                <div class="checkout__input">
                    <p>Thành phần<span>*</span></p>
                    <select wire:model="item">
                        <option value=0>--Chọn--</option>
                        @foreach ($introduces as $item)
                            <option value={{ $item['id'] }}>{{ $item['title'] }}</option>
                        @endforeach
                    </select>
                    <p class="error">
                        @error('item')
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
                    {{ 'Save' }}</button>

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
