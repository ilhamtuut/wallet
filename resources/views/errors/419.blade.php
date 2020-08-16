@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))
@section('action')
<a href="{{route('home')}}" class="btn btn-primary btn-block btn-lg"><i class="fa fa-home"></i> Back to Homepage</a>
@endsection
