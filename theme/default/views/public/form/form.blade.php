@if(Session::has('formSuccess') && !$builder)
	<success closable>
		<p>{{ Session::get('formSuccess') }}</p>
	</success>
@endif

<form 
	@if (!$builder)
		action="{{ URL::route('formr', array($modelId)) }}" 
		method="POST"
	@else
		action="javascript:alert('This action is not available on the form builder.');"
	@endif
	class="@if($form->type == null) form-horizontal @else form-{{ $form->type }} @endif">

	{{-- Send the Form Id --}}
	<input type="hidden" name="form" value="{{ $form->id }}" />

	@if(isset($form->action))
		<input type="hidden" name="action" value="{{ $form->action }}" />
	@endif

	{{-- Parameters only set with renderByModel --}}
	@if(isset($params) && is_array($params))
		@foreach($params as $key => $param)
			<input type="hidden" name="formParam[{{ $key }}]" value="{{ $param }}" />
		@endforeach
	@endif

	@foreach ($inputs as $input)
		<div class="form-group @if($form->type == 'horizontal') row @endif ">
			
			@if($builder && sizeof($inputs) > 1)
				@include('theme::public.form.actions')
			@endif

			{{ $input->view }}

		</div>
	@endforeach

	@if($builder && !sizeof($inputs))
		<info>Pas d'inputs disponibles</info>
	@endif

</form>
