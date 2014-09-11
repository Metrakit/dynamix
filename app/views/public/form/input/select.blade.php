@if($label)
	<label class="col-sm-2 control-label">{{ $label }}</label>
	<div class="col-sm-6">
@endif
	<select name="{{ $name }}" title="{{ $title }}" class="form-control" name="">
		@foreach ($options as $option)	
			<option value="{{ $option->value }}"> {{ $option->key }} </option>
		@endforeach
	</select>
	<p class="help-block"> {{ $helper }} </p>
@if($label)	
	</div>
@endif
