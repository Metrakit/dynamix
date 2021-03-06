@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.tag_edit') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.tag_edit') }}}</h1>
    </div>
@stop


@section('content')

@include('theme::admin.session.session-message')

<div class="col-sm-9">
<form class="form-horizontal" method="POST" action="{{ URL::to('admin/tag/'.$tag->id ) }}" accept-charset="UTF-8" autocomplete="off">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="put">
    <fieldset>
        @include('theme::admin.tag.form')
    </fieldset>
</form>
</div>
@stop
