@extends('errors::illustrated-layout')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))
@section('image')
<img style="width: 100%" src="{{ asset('img/404.svg') }}"/>
@endsection
