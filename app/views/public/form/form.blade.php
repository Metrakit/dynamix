@if(Session::has('formSuccess'))
	<success closable>
		<p>{{ Session::get('formSuccess') }}</p>
	</success>
@endif

<form action="{{ URL::route('form') }}" class="form-{{ $form->type }}" method="POST">

	{{-- Send the Form Id --}}
	<input type="hidden" name="form" value="{{ $form->id }}" />

	@foreach ($inputs as $input)
		<div class="form-group @if($form->type == 'horizontal') row @endif @if($errors->has($input->name)) has-error @endif ">
			{{ $input->view }}
		</div>
	@endforeach

</form>