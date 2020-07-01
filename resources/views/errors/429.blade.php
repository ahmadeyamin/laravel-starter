@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
@section('image')
<img style="width: 100%" src="{{ asset('img/404.svg') }}"/>
@endsection
