{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-6 page-border-right form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="6">
	<input type="hidden" name="order" value="1">
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-6 page-border-left form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="6">
	<input type="hidden" name="order" value="2">
{{ Form::close() }}

<div class="clearfix"></div>

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-6 page-border-right form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="6">
	<input type="hidden" name="order" value="3">
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-6 page-border-left form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="6">
	<input type="hidden" name="order" value="4">
{{ Form::close() }}
