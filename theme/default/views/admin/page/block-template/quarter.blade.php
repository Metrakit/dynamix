<div class="page-block-remove">
<span class="page-lineblock-remove-btn"></span>
<span class="page-lineblock-confirm-remove-btn"></span>
{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-3 page-double-height page-border-right form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="3">
	<input type="hidden" name="order" value="1">
@include('theme::admin.page.form_select_resource')
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-3 page-double-height page-border-right page-border-left form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="3">
	<input type="hidden" name="order" value="2">
@include('theme::admin.page.form_select_resource')
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-3 page-double-height page-border-right page-border-left form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="3">
	<input type="hidden" name="order" value="3">
@include('theme::admin.page.form_select_resource')
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-3 page-double-height page-border-left form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="3">
	<input type="hidden" name="order" value="4">
@include('theme::admin.page.form_select_resource')
{{ Form::close() }}
<div class="clearfix"></div>
</div>