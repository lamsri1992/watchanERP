@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
@include('layouts.headers.guest')

<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                    @if($message = Session::get('valid'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <span>{{ $message }}</span>
                    </div>
                    @endif
                    <form role="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="text-center">
                            <div class="col-lg-12">
                                <img src="{{ asset('argon') }}/img/brand/logo.png" width="50%">
                                <h3 class="text-bold">
                                    {{ __('ระบบ ERP :: โรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา') }}
                                </h3>
                            </div>
                            <h4 class="text-muted">กรุณาลงชื่อเข้าใช้งาน</h4>
                        </div>
                        <div class="form-group{{ $errors->has('barcode') ? ' has-danger' : '' }} mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                </div>
                                <input
                                    class="form-control{{ $errors->has('barcode') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Username') }}" type="text" name="barcode"
                                    value="{{ old('barcode') }}" required autofocus
                                    onkeyup="this.value = this.value.toUpperCase();">
                            </div>
                            @if($errors->has('barcode'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('barcode') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div
                            class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" placeholder="{{ __('Password') }}" type="password"
                                    required>
                            </div>
                            @if($errors->has('password'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="text-center">
                            <button type="submit"
                                class="btn btn-success my-4"><i class="fa fa-sign-in-alt"></i> {{ __('ลงชื่อเข้าใช้งาน') }} </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
