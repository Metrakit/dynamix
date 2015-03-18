@section('scriptOnReady')
	$('.iframe-filemanager').fancybox({	
	'width'		: 900,
	'height'	: 600,
	'type'		: 'iframe',
    'autoScale' : false
    });
@append

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

		<div class="input-group ">
			<div class="input-group-addon">
                <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{ $locale->flag }}" alt="{{ $locale->id }}"/></span>
            </div>
			<input 
				id="input_{{ $input->name }}_lang_{{ $locale->id }}" 
				name="{{ $input->name }}_lang_{{ $locale->id }}" 
				title="{{ $input->title }}" 
				class="form-control" 
				type="{{ $input->type }}" 
				placeholder="{{ $input->placeholder }}" 
				value="{{ $input->value[$locale->id] }}" 
			/>
			<a class="input-group-addon btn iframe-filemanager" href="{{ URL::to('filemanager/dialog.php?type='.$input->typeFilemanager.'&amp;field_id=input_'.$input->name.'_lang_'.$locale->id.'&amp;akey='.Config::get('app.key')) }}">{{ Lang::get('input.filemanager_select') }}</a>
		</div>

		@if($errors->has($input->name . '_lang_' . $locale->id)) 
        	<?php $input->i18nInpError = true; ?>
	        <p class="text-danger"> 
				{{ $errors->first($input->name . '_lang_' . $locale->id) }}
			</p>
		@endif

	@endforeach
@else	

	<div class="input-group">
		<input id="input_{{ $input->name }}" name="{{ $input->name }}" title="{{ $input->title }}" class="form-control" type="{{ $input->type }}" placeholder="{{ $input->placeholder }}" value="{{ $input->value }}" />
		<a class="input-group-addon btn iframe-filemanager" href="{{ URL::to('filemanager/dialog.php?type='.$input->typeFilemanager.'&amp;field_id=input_'.$input->name.'&amp;akey='.Config::get('app.key')) }}">{{ Lang::get('input.filemanager_select') }}</a>
	</div>

@endif

@if($form->type != 'inline' && !$input->i18nInpError)
	<p class="@if($errors->has($input->name)) text-danger @else help-block @endif"> 
		@if($errors->has($input->name) && !$input->multiLang) 
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
