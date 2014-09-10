<div class="form-group">
	<select class="form-control" name="">
		@foreach ($options as $option)	
			<option value="{{ $option->i18n_value }}"> {{ $option->i18n_key }} </option>
		@endforeach
	</select>
	<p class="help-block"> {{ $i18n_helper }} </p>
</div>
