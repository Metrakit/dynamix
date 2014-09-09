<form action="" class="form-horizontal">

NI HAO !

@foreach (Former::render($inputs) as $input)
	{{ $input->view }}
@endforeach


</form>