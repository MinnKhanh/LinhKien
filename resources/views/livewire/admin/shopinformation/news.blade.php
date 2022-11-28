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
        <h4 class="co-6 checkout__input mb-5 border-bottom">
            {{ isset($isedit) ? 'Cập nhật bản tin' : 'Tạo bản tin mới' }}
        </h4>
        <div class="col-12 form-row">
            <div class="col-6">
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
            <div class="col-6">
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
        </div>
        <div class="col-12 form-row">
            <div class="col-12">
                <div class="checkout__input">
                    <p>Nội dung<span>*</span></p>
                    <input type="text" wire:model.defer="content">
                    <p class="error">
                        @error('content')
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
                    <img src="{{ $photo ? $photo->temporaryUrl() : ($img ? asset('storage/news/' . $img) : '') }}"
                        alt="">
                </div>
            </div>
        </div>

        <div class="form-group col-12 row justify-content-center btn-group-mto mt-5">
            <div>
                <a href="{{ route('admin.brand.index') }}" class="btn btn-default">
                    <i class="fa fa-arrow-left"></i>
                    Back
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
