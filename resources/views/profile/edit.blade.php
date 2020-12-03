<div class="col-xl-8 order-xl-1">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <h3 class="col-12 mb-0">
                    {{ __('แก้ไขข้อมูลส่วนตัว') }}
                </h3>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                @csrf
                @method('put')

                <h6 class="heading-small text-muted mb-4">
                    {{ __('เปลี่ยนแปลงรหัสผ่าน') }}
                </h6>

                @if(session('password_status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('password_status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="pl-lg-4">
                    <div
                        class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                        <label class="form-control-label"
                            for="input-current-password">{{ __('รหัสผ่านเดิม') }}</label>
                        <input type="password" name="old_password" id="input-current-password"
                            class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Current Password') }}" value="" required>

                        @if($errors->has('old_password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('old_password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div
                        class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label class="form-control-label"
                            for="input-password">{{ __('รหัสผ่านใหม่') }}</label>
                        <input type="password" name="password" id="input-password"
                            class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('New Password') }}" value="" required>

                        @if($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"
                            for="input-password-confirmation">{{ __('ยืนยันรหัสผ่านใหม่') }}</label>
                        <input type="password" name="password_confirmation" id="input-password-confirmation"
                            class="form-control form-control-alternative"
                            placeholder="{{ __('Confirm New Password') }}" value=""
                            required>
                    </div>

                    <div class="text-left">
                        <button type="submit"
                            class="btn btn-success mt-4">{{ __('บันทึกการแก้ไข') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>