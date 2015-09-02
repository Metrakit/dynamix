{{--@if($input->label)

	@if($form->type != 'inline')
		<label class="@if($form->type == 'horizontal') col-sm-2 @endif control-label">{{ $input->label }}</label>
	@endif

	@if($form->type == 'horizontal')
		<div class="col-sm-6">
	@endif

@endif--}}


@if($form->type == 'horizontal')
	<div class="col-sm-push-2 col-sm-6">
@endif
	
<button type="{{ $input->type }}" name="{{ $input->name }}" class="btn btn-default" value="send">{{ $input->title }}</button>

@if($form->type == 'horizontal') 

	</div>

	<div class="clearfix"></div>

@endif
