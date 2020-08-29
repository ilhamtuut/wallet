@extends('layouts._app')

@section('content')
<div class="row mt-x">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-envelope"></i> {{ __('Verify Your Email Address') }}</h3>
            </div>
            <div class="panel-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                <div class="mb">
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                </div>
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> {{ __('Click here to request another') }}</button>.
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
