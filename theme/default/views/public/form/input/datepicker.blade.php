@section('scriptOnReady')
var options = []
options.locale = "{{ App::getLocale() }}"
masterClass.addQueue(
	@if ($input->datepicker_type == "date")
		datePick.displayDate(options)
	@elseif ($input->datepicker_type == "time")
		datePick.displayTime(options)
	@else
		datePick.displayDateTime(options) 
	@endif
);
@append

@if($input->label)

	@if($form->type != 'inline')
		<label class="@if($form->type == 'horizontal') col-sm-2 @endif control-label">{{ $input->label }}</label>
	@endif

	@if($form->type == 'horizontal')
		<div class="col-sm-6">	
	@endif

@endif

<div class="input-group date 
@if ($input->datepicker_type == 'date') 
	date-picker
@elseif ($input->datepicker_type == 'time')
	time-picker
@else
	date-time-picker
@endif
">
    <input type="text" class="form-control" name="{{ $input->name }}" placeholder="{{ $input->placeholder }}" value="{{ $input->value }}"/>
    <span class="input-group-addon">
    	<span class="glyphicon 
			@if ($input->datepicker_type == 'date') 
				glyphicon-calendar
			@elseif ($input->datepicker_type == 'time')
				glyphicon-time
			@else
				glyphicon-calendar
			@endif
    	"></span>
    </span>
</div>

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

