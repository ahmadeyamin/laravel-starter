@extends('errors::illustrated-layout')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@section('image')
<img style="width: 100%" src="{{ asset('img/404.svg') }}"/>
@endsection
