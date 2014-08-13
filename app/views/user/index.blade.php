@extends('site.layout.master')


@section('meta_title')
{{{ Lang::get('user/user.user') }}} |
@parent
@stop

@section('ariane')
@parent
&nbsp;<a href="{{ asset( 'user' ) }}">{{$user->firstname}} {{$user->lastname}}</a>
@stop


@section('content')
    @if ( Session::get('error') )
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error') }}
    </div>
    @endif
    @if ( Session::get('notice') )
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('notice') }}
    </div>
    @endif
    @if ( Session::get('success') )
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('success') }}
    </div>
    @endif

    <h1>Hello {{$user->firstname}},</h1>
    <table class="table">
    	<tr>
    		<th>Nom</th><td>{{$user->lastname}}</td>
    	</tr>
    	<tr>
    		<th>Prénom</th><td>{{$user->firstname}}</td>
    	</tr>
    	<tr>
    		<th>Pseudo</th><td>{{$user->pseudo}}</td>
    	</tr>
    	<tr>
    		<th>Email</th><td>{{$user->email}}</td>
    	</tr>
    </table>
    <a href="{{asset('/user/' . $user->id . '/edit')}}" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Modifier profil</a>
@stop
