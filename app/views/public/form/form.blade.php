<form action="" class="form-horizontal">

	@foreach ($inputs as $input)
		{{ $input->view }}
	@endforeach

</form>