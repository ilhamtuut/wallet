@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
@section('action')
<a href="{{route('home')}}" class="btn btn-primary btn-block btn-lg"><i class="fa fa-home"></i> Back to Homepage</a>
@endsection
