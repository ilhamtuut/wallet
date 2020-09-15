@extends('layouts._app',['page'=>'login'])
@section('content')
<div class="row mt-x">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{ __('Login') }}</h3>
            </div>
            <div class="panel-body">
                @if (Session::has('failed'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <strong>Oh snap!</strong> {{ session('failed') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}" id="login">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-md-4 control-label mt-5 text-right">{{ __('E-Mail Address') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">

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
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8" required autocomplete="current-password" placeholder="{{ __('Password') }}">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-4"></div>
                        <div class="col-md-8 offset-md-4">
                            <button type="button" class="btn btn-primary" id="btn-action" onclick="openModal()">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
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
    var frmRes = $('#login');
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
            $('#login').submit();
        }else{
            $("#notice").removeClass('hidden');
            setTimeout(function () {
                $("#notice").addClass('hidden');
            }, 2000);
        }
    }
</script>
@endsection
