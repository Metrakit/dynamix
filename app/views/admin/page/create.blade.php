@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.page_create') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.page_create') }}}</h1>
    </div>
@stop


@section('content')

@include('includes.session-message')

<div class="col-sm-12">
{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off' ) ) }}
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

        @include('admin.page.form')

        <button type="submit" class="btn btn-primary">Créer la page !</button>
        <!-- ./ form actions -->
{{ Form::close() }}
</div>
<div class="clearfix"></div>
@stop
