@if(Session::has('formSuccess'))
	<success closable>
		<p>{{ Session::get('formSuccess') }}</p>
	</success>
@endif

<form action="{{ URL::route('form') }}" class="form-horizontal" method="POST">

	{{-- Send the Form Id --}}
	<input type="hidden" name="form" value="{{ $formId }}" />

	@foreach ($inputs as $input)
		<div class="form-group row @if($errors->has($input->name)) has-error @endif ">
			{{ $input->view }}
		</div>
	@endforeach

</form>