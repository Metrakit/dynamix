@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.users') }}} |
@parent
@stop

@section('content')

@include('includes.session-message')

<div class="profil">
	<div class="img-center">
		<img class="img-circle img-responsive" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=256px"}}" alt="gravatar" />
	</div>
	<h1 class="text-center text-capitalize">{{ $user->firstname . ' '. $user->lastname}}</h1>
	<h3 class="text-center text-capitalize">{{ $user->rolesList() }}</h3>
	<p class="text-center text-help"><a href="{{ $user->email }}">{{ $user->email }}</a></p>
</div>


@stop