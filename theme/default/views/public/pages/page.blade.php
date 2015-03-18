@extends('theme::public.layout.master')


@include('theme::public.includes.meta', array( 'object' => $page ))

@include('theme::public.includes.ariane', array( 'object' => $page ))


@section('content')
@include('theme::public.session.session-message')

{{ Pager::render($page) }}

{{-- To surcharge for comment module --}}
<hr>
@include('theme::public.comment.index', array('object' => $page))
@stop