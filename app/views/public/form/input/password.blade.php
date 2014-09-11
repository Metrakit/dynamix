@if($label)
	<label class="col-sm-2 control-label">{{ $label }}</label>
	<div class="col-sm-6">
@endif
	<input name="{{ $name }}" title="{{ $title }}" class="form-control" type="{{ $type }}" placeholder="{{ $placeholder }}"></input>
	<p class="help-block"> {{ $helper }} </p>
@if($label)	
	</div>
@endif


