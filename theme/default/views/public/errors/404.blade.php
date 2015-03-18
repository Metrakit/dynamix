@extends('theme::public.layout.master')


@section('title')
{{{ Lang::get('public.page_moved_or_deleted') }}} | 
@parent
@stop


@section('content')
	<h1>Ouuups !!! {{{ Lang::get('public.page_moved_or_deleted') }}}</h1>
@stop