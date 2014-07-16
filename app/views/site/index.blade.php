@extends('site.layout.master')

@section('meta_title')
{{ $index->i18n_meta_title() }} | @parent
@stop

@section('meta_description')
{{ $index->i18n_meta_description() }}
@stop


@section('content')
{{ $index->i18n_content() }}
@stop