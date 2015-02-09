@extends('admin.page.create')

@section('template')

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'col-md-3 form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="3">
	<input type="hidden" name="order" value="1">
	@include('admin.page.block.wysiwyg')
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'col-md-3 form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="3">
	<input type="hidden" name="order" value="2">
	@include('admin.page.block.wysiwyg')
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'col-md-3 form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="3">
	<input type="hidden" name="order" value="3">
	@include('admin.page.block.wysiwyg')
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'col-md-3 form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="3">
	<input type="hidden" name="order" value="4">
	@include('admin.page.block.wysiwyg')
{{ Form::close() }}

@stop