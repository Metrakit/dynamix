{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-3 page-double-height page-border-right form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="3">
	<input type="hidden" name="order" value="1">
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-3 page-double-height page-border-right page-border-left form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="3">
	<input type="hidden" name="order" value="2">
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-3 page-double-height page-border-right page-border-left form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="3">
	<input type="hidden" name="order" value="3">
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-3 page-double-height page-border-left form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="3">
	<input type="hidden" name="order" value="4">
{{ Form::close() }}