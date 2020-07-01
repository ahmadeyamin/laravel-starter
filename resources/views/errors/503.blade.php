@extends('errors::illustrated-layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Service Unavailable'))
@section('image')
<img style="width: 100%" src="{{ asset('img/404.svg') }}"/>
@endsection
