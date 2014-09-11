<form action="" class="form-horizontal">

	@foreach ($inputs as $input)
		<div class="form-group row">
			{{ $input->view }}
		</div>
	@endforeach

</form>