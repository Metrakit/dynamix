@if (Session::has('success'))
	<success closable>{{ Session::get('success') }}</success>
@elseif (Session::has('error'))
	<danger closable>{{ Session::get('error') }}</danger>
@endif