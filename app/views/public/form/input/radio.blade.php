<div class="form-group">
	@if($type == "radio" || $type == "checkbox")
		<input class="form-control" type="{{ $type }}" placeholder="{{ $i18n_placeholder }}"/>
	@elseif($type == "textarea")
		<textarea class="form-control" type="{{ $type }}" placeholder="{{ $i18n_placeholder }}"></textarea>
	@else
		<input class="form-control" type="{{ $type }}" placeholder="{{ $i18n_placeholder }}"></input>
	@endif
	<p class="help-block"> {{ $i18n_helper }} </p>
</div>