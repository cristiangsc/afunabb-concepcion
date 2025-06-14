@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message')
{{ __($exception->getMessage() ?: 'Forbidden') }}
<br>
<a href="{{ route('dashboard') }}">{{ __('dashboard') }}</a>
@endsection
