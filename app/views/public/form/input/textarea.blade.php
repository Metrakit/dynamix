@if($input->label)

	@if($form->type != 'inline')
		<label class="@if($form->type == 'horizontal') col-sm-2 @endif control-label">{{ $input->label }}</label>
	@endif

	@if($form->type == 'horizontal')
		<div class="col-sm-6">
	@endif

@endif

@if($input->multiLang)
	@foreach($locales as $locale)

		<textarea 
			name="{{ $input->name }}_{{ $locale->id }}" 
			title="{{ $input->title }}" 
			class="form-control @if(Config::get('app.locale') != $locale->id) hidden @endif input_{{ $locale->id }} " 
			type="{{ $input->type }}" 
			placeholder="{{ $input->placeholder }}">{{ $input->value }}</textarea>

	@endforeach
@else	
	<textarea name="{{ $input->name }}" class="form-control" type="{{ $input->type }}" placeholder="{{ $input->placeholder }}">{{ $input->value }}</textarea>
@endif

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
	<div class="clearfix"></div>

@endif