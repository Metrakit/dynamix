@extends('public.layout.master')


@include('public.includes.meta', array( 'object' => $page ))

@include('public.includes.ariane', array( 'object' => $page ))


@section('content')
@include('includes.session-message')


{{-- #################### EXAMPLE #################### --}}
{{-- EXAMPLE OF CREATE A FORM BY A MODEL --}}
{{ Former::createFromModel(new Gallery) }}
{{-- #################### EXAMPLE #################### --}}


{{ Pager::render($page) }}

@stop