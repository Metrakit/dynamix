@extends('theme::public.layout.master')


@section('title')
{{{ Lang::get('public.permission_denied') }}} | 
@parent
@stop


@section('content')
	<h1>Ouuups !!! {{{ Lang::get('public.permission_denied') }}}</h1>
@stop