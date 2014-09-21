@if($input->label)

	@if($form->type != 'inline')
		<label class="@if($form->type == 'horizontal') col-sm-2 @endif control-label">{{ $input->label }}</label>
	@endif

	@if($form->type == 'horizontal')
		<div class="col-sm-6">
	@endif

@endif

<textarea name="{{ $input->name }}" class="form-control" type="{{ $input->type }}" placeholder="{{ $input->placeholder }}">{{ $input->value }}</textarea>

@if($form->type != 'inline')
	<p class="help-block"> 
		@if($errors->has($input->name)) 
			{{ $errors->first($input->name) }}
		@else
			{{ $input->helper }} 
		@endif
	</p>
@endif

@if($form->type == 'horizontal' && $input->label)

	</div>

@endif