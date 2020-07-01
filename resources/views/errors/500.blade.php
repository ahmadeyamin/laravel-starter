@extends('errors::illustrated-layout')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
@section('image')
<img style="width: 100%" src="{{ asset('img/404.svg') }}"/>
@endsection
