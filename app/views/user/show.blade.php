@extends('site.layout.master')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.profile') }}} |
@parent
@stop

{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ asset( 'user/'.$user->id ) }}">Profil de {{$user->pseudo}}</a>
@stop


{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>User Profile</h1>
</div>
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>{{{Lang::get('user/user.username')}}}</th>
        <th>{{{Lang::get('user/user.signed_up')}}}</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{{$user->id}}}</td>
        <td>{{{$user->firstname()}}}</td>
        <td>{{{$user->lastname()}}}</td>
        <td>{{{$user->pseudo}}}</td>
    </tr>
    </tbody>
</table>
@stop
