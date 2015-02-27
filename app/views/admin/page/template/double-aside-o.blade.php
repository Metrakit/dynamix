@extends('admin.page.create')

@section('template')

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block pull-right col-md-8 page-border-left form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="8">
	<input type="hidden" name="order" value="1">
	<input type="hidden" name="class" value="pull-right">
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-4 page-border-right page-double-height form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="4">
	<input type="hidden" name="order" value="2">
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block pull-right col-md-8 page-border-left form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="8">
	<input type="hidden" name="order" value="3">
	<input type="hidden" name="class" value="pull-right">
{{ Form::close() }}


@stop