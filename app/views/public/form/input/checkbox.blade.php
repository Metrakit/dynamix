@if($input->label)

	@if($form->type != 'inline') 
		<label class="@if($form->type == 'horizontal') col-sm-2 @endif control-label">{{ $input->label }}</label> 
	@endif

	@if($form->type == 'horizontal') 
		<div class="col-sm-6"> 
	@endif

@endif

<input name="{{ $input->name }}" title="{{ $input->title }}" type="{{ $input->type }}" placeholder="{{ $input->placeholder }}" @if($input->value) checked @endif />

@if($form->type != 'inline')

	<p class="help-block"> 
		@if($errors->has($input->name)) 
			{{ $errors->first($input->name) }}
		@else
			@if(isset($input->helper))
				{{ $input->helper }} 
			@endif
		@endif
	</p>

@endif


@if($form->type == 'horizontal' && $input->label) 
		
	</div> 

	<div class="clearfix"></div>

@endif
