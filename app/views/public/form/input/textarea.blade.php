@if($label)
	<label class="col-sm-2 control-label">{{ $label }}</label>
	<div class="col-sm-6">
@endif
	<textarea name="{{ $name }}" class="form-control" type="{{ $type }}" placeholder="{{ $placeholder }}">{{ $value }}</textarea>
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
