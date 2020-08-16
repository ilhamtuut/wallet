@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@section('action')
<a href="{{route('home')}}" class="btn btn-primary btn-block btn-lg"><i class="fa fa-home"></i> Back to Homepage</a>
@endsection
