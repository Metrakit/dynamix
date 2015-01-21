@section('scriptOnReady')
	$('.iframe-filemanager').fancybox({	
	'width'		: 900,
	'height'	: 600,
	'type'		: 'iframe',
    'autoScale'    	: false
    });
@endsection

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

		<div class="input-group @if(Config::get('app.locale') != $locale->id) hidden @endif input_{{ $locale->id }} ">
			<input 
				id="input_{{ $input->name }}_{{ $locale->id }}" 
				name="{{ $input->name }}_{{ $locale->id }}" 
				title="{{ $input->title }}" 
				class="form-control" 
				type="{{ $input->type }}" 
				placeholder="{{ $input->placeholder }}" 
				value="{{ $input->value }}" 
			/>
			<a class="input-group-addon btn iframe-filemanager" href="{{ URL::to('filemanager/dialog.php?type='.$input->typeFilemanager.'&amp;field_id=input_'.$input->name.'_'.$locale->id.'&amp;akey='.Config::get('app.key')) }}">Select</a>
		</div>

	@endforeach
@else	

	<div class="input-group">
		<input id="input_{{ $input->name }}" name="{{ $input->name }}" title="{{ $input->title }}" class="form-control" type="{{ $input->type }}" placeholder="{{ $input->placeholder }}" value="{{ $input->value }}" />
		<a class="input-group-addon btn iframe-filemanager" href="{{ URL::to('filemanager/dialog.php?type='.$input->typeFilemanager.'&amp;field_id=input_'.$input->name.'&amp;akey='.Config::get('app.key')) }}">Select</a>
	</div>

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
