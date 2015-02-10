@if($input->label)

	@if($form->type != 'inline')
		<label class="@if($form->type == 'horizontal') col-sm-2 @endif control-label">{{ $input->label }}</label>
	@endif

	@if($form->type == 'horizontal')
		<div class="col-sm-6">
	@endif

@endif

<select name="{{ $input->name }}" title="{{ $input->title }}" class="form-control"  value="{{ $input->key }}">
	@foreach ($input->options as $option)	
		 {{-- var_dump($input->key) --}}
		  {{-- var_dump($option->key) --}}
		<option value="{{ $option->key }}" @if($input->key == $option->key) selected @endif> {{ $option->value }} </option>
	@endforeach
</select>

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
