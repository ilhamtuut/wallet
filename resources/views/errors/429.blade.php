@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
@section('action')
<a href="{{route('home')}}" class="btn btn-primary btn-block btn-lg"><i class="fa fa-home"></i> Back to Homepage</a>
@endsection
