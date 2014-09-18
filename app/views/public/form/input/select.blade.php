@if($label)
	<label class="col-sm-2 control-label">{{ $label }}</label>
	<div class="col-sm-6">
@endif
	<select name="{{ $name }}" title="{{ $title }}" class="form-control"  value="{{ $value }}">
		@foreach ($options as $option)	
			<option value="{{ $option->value }}" @if($value == $option->value) selected @endif> {{ $option->key }} </option>
		@endforeach
	</select>
	<p class="help-block"> 
		@if($errors->has($name)) 
			{{ $errors->first($name) }}
		@else
			{{ $helper }} 
		@endif
	</p>
@if($label)	
	</div>
@endif
