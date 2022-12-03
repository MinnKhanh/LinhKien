@extends('layouts.layoutlogin')

@section('content')
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Đổi mật khẩu') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.changepassword') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="oldpassword"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Mật khẩu cũ') }}</label>

                                <div class="col-md-6">
                                    <input id="oldpassword" type="password"
                                        class="form-control @error('oldpassword') is-invalid @enderror" name="oldpassword"
                                        autocomplete="current-password">

                                    @error('oldpassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="newpassword"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Mật khẩu mới') }}</label>

                                <div class="col-md-6">
                                    <input id="newpassword" type="password"
                                        class="form-control @error('newpassword') is-invalid @enderror" name="newpassword"
                                        autocomplete="current-password">

                                    @error('newpassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="passwordconfirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Xác nhận mật khẩu mới') }}</label>

                                <div class="col-md-6">
                                    <input id="passwordconfirm" type="password"
                                        class="form-control @error('passwordconfirm') is-invalid @enderror"
                                        name="passwordconfirm" autocomplete="current-password">

                                    @error('passwordconfirm')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Cập nhật mật khẩu') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
