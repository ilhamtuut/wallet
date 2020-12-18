@extends('layouts._app',['page'=>'register'])
@section('content')
<div class="row mt-x">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><img src="{{asset('dist/img/favicon.png')}}" width="25px"> {{ __('Register') }}</h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('register') }}" id="register">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 control-label mt-5 text-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Name') }}">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 control-label mt-5 text-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 control-label mt-5 text-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 control-label mt-5 text-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" minlength="8" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-6 offset-md-4">
                            <button type="button" class="btn btn-primary" id="btn-action" onclick="openModal()">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var frmRes = $('#register');
    var frmResValidator = frmRes.validate();
    var captcha = 0;

    function openModal() {
        var valid = frmRes.valid();
        if(valid){
            $('#modal_capctha').modal('show'); 
        }
    }

    $('#captcha').sliderCaptcha({
        repeatIcon: 'fa fa-redo',
        onSuccess: function () {
            $('#modal_capctha').modal('hide'); 
            $('#text-info').removeClass('hidden');
            $('#btn-action').attr('disabled','disabled');
            captcha = 1;
            onSubmit();
        }
    });

    function onSubmit() {
        if(captcha == 1){
            $('#register').submit();
        }else{
            $("#notice").removeClass('hidden');
            setTimeout(function () {
                $("#notice").addClass('hidden');
            }, 2000);
        }
    }
</script>
@endsection

