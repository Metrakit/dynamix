@extends('public.layout.master')


@include('public.includes.meta', array( 'object' => $page ))

@include('public.includes.ariane', array( 'object' => $page ))


@section('content')
{{ Pager::render($page) }}
@stop