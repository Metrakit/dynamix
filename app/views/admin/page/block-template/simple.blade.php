{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block page-double-height form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="12">
	<input type="hidden" name="order" value="1">
{{ Form::close() }}
