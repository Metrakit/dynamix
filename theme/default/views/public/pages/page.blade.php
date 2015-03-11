@extends('public.layout.master')


@include('public.includes.meta', array( 'object' => $page ))

@include('public.includes.ariane', array( 'object' => $page ))


@section('content')
@include('public.session.session-message')

{{ Pager::render($page) }}

{{-- To surcharge for comment module --}}
<hr>
@include('public.comment.index', array('object' => $page))
@stop