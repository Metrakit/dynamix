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

        <div class="input-group">
            <div class="input-group-addon">
                <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{ $locale->flag }}" alt="{{ $locale->id }}"/></span>
            </div>
			<input 
				name="{{ $input->name }}_lang_{{ $locale->id }}" 
				title="{{ $input->title }}" 
				class="form-control input_{{ $locale->id }} " 
				type="{{ $input->type }}" 
				placeholder="{{ $input->placeholder }}" 
				value="{{ $input->value[$locale->id] }}" 
			/>

			@if (isset($input->group))
				<div class="input-group-addon">
	               {{ $input->group }}
	            </div>
			@endif

        </div>

        @if($errors->has($input->name . '_lang_' . $locale->id)) 
        	<?php $input->i18nInpError = true; ?>
	        <p class="text-danger"> 
				{{ $errors->first($input->name . '_lang_' . $locale->id) }}
			</p>
		@endif

	@endforeach
@else	

	@if (isset($input->group))
		<div class="input-group">
	@endif
			<input name="{{ $input->name }}" title="{{ $input->title }}" class="form-control" type="{{ $input->type }}" placeholder="{{ $input->placeholder }}" value="{{ $input->value }}" 
				@if (isset($input->range) && $input->type == "number")
					@if (isset($input->range['min']))
						 min={{ $input->range['min'] }} 
					@endif
					@if (isset($input->range['max']))
						 max={{ $input->range['max'] }} 
					@endif
				@endif
			/>
	@if (isset($input->group))
			<div class="input-group-addon">
	           {{ $input->group }}
	        </div>
        </div>
	@endif


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
