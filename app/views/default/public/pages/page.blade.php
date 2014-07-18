@extends('site.layout.master')


@include('site.includes.meta', array( 'object' => $page ))

@include('site.includes.ariane', array( 'object' => $page ))


@section('content')
{{ $page->i18n_content() }}
@stop
