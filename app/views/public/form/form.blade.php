@if(Session::has('formSuccess'))
	<success closable>
		<p>{{ Session::get('formSuccess') }}</p>
	</success>
@endif

<form 
	@if (!$builder)
		action="{{ URL::route('formr', array($modelId)) }}" 
		method="POST"
	@endif
	class="form-{{ $form->type }}">

	{{-- Send the Form Id --}}
	<input type="hidden" name="form" value="{{ $form->id }}" />

	@if(isset($form->action))
		<input type="hidden" name="action" value="{{ $form->action }}" />
	@endif

	@foreach ($inputs as $input)
		<div class="form-group @if($form->type == 'horizontal') row @endif ">
			{{ $input->view }}
		</div>
	@endforeach

	@if($builder && !sizeof($inputs))
		<info>Pas d'inputs disponibles</info>
	@endif

</form>
