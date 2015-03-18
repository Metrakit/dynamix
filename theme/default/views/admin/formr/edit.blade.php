@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.formr') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">Edition d'un formulaire</h1>
    </div>
@stop


@section('content')

{{ Formr::generateForm($form->id) }}

@stop