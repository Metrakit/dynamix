@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.page_edit') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.page_edit') }}}</h1>
    </div>
@stop


@section('content')

@include('includes.session-message')

<div class="col-sm-9">
{{ Form::model($page, array('route' => array('admin.page.update', $page->id), 'method' => 'POST', 'files' => true, 'id' => 'pageForm', 'class' => 'form-horizontal', 'autocomplete' => 'off' ) ) }}
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="_method" value="put" />

        @include('admin.page.form', array('page' => $page))

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <!-- ./ form actions -->
{{ Form::close() }}
</div>
<div class="clearfix"></div>
@stop