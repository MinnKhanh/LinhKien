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
        <h4 class="co-6 checkout__input mb-5 border-bottom"> Thông Tin
        </h4>
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
            <div class="col-4">
                <div class="checkout__input">
                    <p>Email<span>*</span></p>
                    <input type="text" wire:model.defer="email" placeholder="">
                    <p class="error">
                        @error('email')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-2">
                <div class="checkout__input">
                    <p>Tuối<span>*</span></p>
                    <input type="number" wire:model.defer="age" placeholder="">
                    <p class="error">
                        @error('age')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 form-row">
            <div class="col-6">
                <div class="checkout__input">
                    <p>Địa chỉ<span>*</span></p>
                    <input type="text" wire:model.defer="address">
                    <p class="error">
                        @error('address')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-6">
                <div class="checkout__input">
                    <p>Điện thoại<span>*</span></p>
                    <input type="text" wire:model.defer="phone" placeholder="">
                    <p class="error">
                        @error('phone')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 form-row">
            <div class="col-4">
                <div class="checkout__input">
                    <p>Thành phố<span>*</span></p>
                    <input type="text" wire:model.defer="city">
                    <p class="error">
                        @error('city')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="checkout__input">
                    <p>Quần/Huyện<span>*</span></p>
                    <input type="text" wire:model.defer="district" placeholder="">
                    <p class="error">
                        @error('district')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="checkout__input">
                    <p>Giới tính<span>*</span></p>
                    <select wire:model="gender" id="">
                        <option {{ $gender == 1 ? 'selected' : '' }} value=1>Nam</option>
                        <option {{ $gender == 3 ? 'selected' : '' }} value=2>Nữ</option>
                        <option {{ $gender == 4 ? 'selected' : '' }} value=3>Khác</option>
                    </select>
                    <p class="error">
                        @error('gender')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 form-row">
            <div class="col-6">
                <div class="checkout__input">
                    <p> {{ isset($isedit) ? 'Thay Ảnh' : 'Ảnh' }}<span>*</span></p>
                    <input type="file" wire:model="photo">
                    <p class="error">
                        @error('photo')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-6 form-row">
                <div class="col-12 d-flex justify-content-center" style="height: 10rem">
                    <img src="{{ $photo ? $photo->temporaryUrl() : ($img ? asset('storage/user/' . $img) : '') }}"
                        alt="">
                </div>
            </div>
        </div>

        <div class="form-group col-12 row justify-content-center btn-group-mto mt-5">
            <div>
                <a href="{{ route('home') }}" class="btn btn-default">
                    <i class="fa fa-arrow-left"></i>
                    Back
                </a>
                <button wire:click.prevent="store" type="button" class="btn btn-primary"><i class="fa fa-plus"></i>
                    Update</button>

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
