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

        body {
            background: whitesmoke;
            font-family: 'Open Sans', sans-serif;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            height: 36px;
            border-radius: 0px;
        }

        .container {
            max-width: 960px;
            margin: 30px auto;
            padding: 20px;
        }

        h1 {
            font-size: 20px;
            text-align: center;
            margin: 20px 0 20px;

        }

        h1 small {
            display: block;
            font-size: 15px;
            padding-top: 8px;
            color: gray;
        }

        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;


        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;

        }

        .avatar-upload .avatar-edit input {
            display: none;

        }

        .avatar-upload .avatar-edit input+label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all .2s ease-in-out;

        }

        .avatar-upload .avatar-edit input+label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input+label .pencil {
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);

        }

        .avatar-upload .avatar-preview>div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
@endpush
<div class="container">
    <div wire:loading class="loader" style="z-index: 1"></div>
    <form class="row">
        @csrf
        <h4 class="co-6 checkout__input"> {{ isset($isedit) ? 'Update User' : 'New User' }}</h4>
        <div class="col-12 form-row">
            <div class="avatar-upload col-6">
                <div class="avatar-edit">
                    <input type="file" id="imageUpload" wire:model="photo">
                    <label for="imageUpload"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-pencil-fill pencil" viewBox="0 0 16 16">
                            <path
                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                        </svg></label>
                </div>
                <div class="avatar-preview">
                    <div id="imagePreview"
                        style="background-image: url('{{ $photo ? $photo->temporaryUrl() : ($img ? asset('storage/user/' . $img) : '') }}');">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 form-row">
            <div class="col-6">
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
        </div>
        @if (!$isedit)
            <div class="col-12 form-row">
                <div class="col-6">
                    <div class="checkout__input">
                        <p>Password<span>*</span></p>
                        <input type="password" wire:model.defer="password">
                        <p class="error">
                            @error('importprice')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="checkout__input">
                        <p>Confirm Password<span>*</span></p>
                        <input type="password" wire:model.defer="passwordconfirm">
                        <p class="error">
                            @error('price')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-12 form-row">
            <div class="col-6">
                <div class="checkout__input">
                    <p>Address<span>*</span></p>
                    <input type="text" wire:model.defer="address">
                    <p class="error">
                        @error('address')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-3">
                <div class="checkout__input">
                    <p>Age<span>*</span></p>
                    <input type="number" wire:model.defer="age">
                    <p class="error">
                        @error('age')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-3">
                <div class="checkout__input">
                    <p>Gender<span>*</span></p>
                    <select class="custom-select" wire:model.defer="gender">
                        <option>--Chọn--</option>
                        <option value=1>Nam</option>
                        <option value=2>Nữ</option>
                        <option value=3>Khác</option>
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
                    <p>Phone<span>*</span></p>
                    <input type="text" wire:model.defer="phone">
                    <p class="error">
                        @error('phone')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
                </div>
            </div>
            <div class="col-6">
                <div class="checkout__input">
                    <p>Quyền<span>*</span></p>
                    <select class="custom-select" wire:model.defer="permission">
                        <option>--Chọn--</option>
                        @forelse ($roles as $key=>$itemrole)
                            <option value={{ $key }}>
                                {{ $itemrole }}</option>
                        @empty
                        @endforelse
                    </select>
                    <p class="error">
                        @error('permission')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </p>
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
