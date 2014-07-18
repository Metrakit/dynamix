@extends('site.layout.master')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.user') }}} |
@parent
@stop

{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ asset( 'user' ) }}">{{$user->firstname()}} {{$user->lastname()}}</a>
@stop


{{-- Content --}}
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

    <h1>Hello {{$user->firstname()}},</h1>
    <table>
    	<tr>
    		<th>Nom</th><td>{{$user->lastname()}}</td>
    	</tr>
    	<tr>
    		<th>Prénom</th><td>{{$user->firstname()}}</td>
    	</tr>
    	<tr>
    		<th>Pseudo</th><td>{{$user->pseudo}}</td>
    	</tr>
    	<tr>
    		<th>Email</th><td>{{$user->email}}</td>
    	</tr>
    </table>
@stop
