<div class="img-center">
	<img class="img-circle img-responsive" height="256px" width="256px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=256px"}}" alt="gravatar" />
</div>
<h4 class="text-center text-capitalize">{{ $user->rolesList() }}</h4>
<p class="text-center"><a href="mailto:{{$user->email}}">{{$user->email}}</a> {{(isset($btn_name) ? $btn_name : '')}}</p>