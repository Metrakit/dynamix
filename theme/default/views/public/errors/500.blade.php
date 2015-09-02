@extends('theme::public.layout.master')


@section('title')
{{{ Lang::get('public.fatal_error') }}} | 
@parent
@stop


@section('content')
	<h1>Ouuups !!! {{{ Lang::get('public.fatal_error') }}}</h1>
@stop