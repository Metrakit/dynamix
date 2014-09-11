@if($label)
	<label class="col-sm-2 control-label">{{ $label }}</label>
	<div class="col-sm-6">
@endif
	<textarea name="{{ $name }}" class="form-control" type="{{ $type }}" placeholder="{{ $placeholder }}"></textarea>
	<p class="help-block"> {{ $helper }} </p>
@if($label)	
	</div>
@endif
