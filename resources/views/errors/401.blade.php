@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))
@section('action')
<a href="{{route('home')}}" class="btn btn-primary btn-block btn-lg"><i class="fa fa-home"></i> Back to Homepage</a>
@endsection
