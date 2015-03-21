<div class="page-block-remove">
<span class="page-lineblock-remove-btn"></span>
<span class="page-lineblock-confirm-remove-btn"></span>
{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-6 page-border-right form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="6">
	<input type="hidden" name="order" value="1">
@include('theme::admin.page.form_select_resource')
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-6 page-border-left form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="6">
	<input type="hidden" name="order" value="2">
	<input type="hidden" name="'is_clearfixed' => true" value="1">
@include('theme::admin.page.form_select_resource')
{{ Form::close() }}
<div class="clearfix"></div>
</div>

<div class="page-block-remove">
<span class="page-lineblock-remove-btn"></span>
<span class="page-lineblock-confirm-remove-btn"></span>
{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-6 page-border-right form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="6">
	<input type="hidden" name="order" value="3">
@include('theme::admin.page.form_select_resource')
{{ Form::close() }}

{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'page-block col-md-6 page-border-left form-horizontal', 'autocomplete' => 'off' ) ) }}
	<input type="hidden" name="_trigger_md" value="6">
	<input type="hidden" name="order" value="4">
	<input type="hidden" name="'is_clearfixed' => true" value="1">
@include('theme::admin.page.form_select_resource')
{{ Form::close() }}
<div class="clearfix"></div>
</div>