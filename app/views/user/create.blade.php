@extends('site.layout.master')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.register') }}} |
@parent
@stop

{{-- Update the Meta Description --}}
@section('meta_description')
Création d'un compte sur le blog du salon de coiffure pour homme à Lyon, Daniel C.
@stop

{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ asset( 'user/create' ) }}">Création de compte</a>
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>{{{ Lang::get('site.sign_up')}}}</h1>
</div>
<form class="form-horizontal" method="POST" action="{{ URL::to('user') }}" accept-charset="UTF-8" autocomplete="off">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="pseudo">{{ Lang::get('user/user.pseudo') }}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="1" placeholder="{{ Lang::get('user/user.pseudo') }}" type="text" name="pseudo" id="pseudo" value="{{ Input::old('pseudo') }}">
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="lastname">{{ Lang::get('user/user.lastname') }}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="2" placeholder="{{ Lang::get('user/user.lastname') }}" type="text" name="lastname" id="lastname" value="{{ Input::old('lastname') }}">
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="firstname">{{ Lang::get('user/user.firstname') }}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="3" placeholder="{{ Lang::get('user/user.firstname') }}" type="text" name="firstname" id="firstname" value="{{ Input::old('firstname') }}">
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="email">{{ Lang::get('user/user.email') }}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="4" placeholder="{{ Lang::get('user/user.email') }}" type="text" name="email" id="email" value="{{ Input::old('email') }}">
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="password">{{ Lang::get('user/user.password') }}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="5" placeholder="{{ Lang::get('user/user.password') }}" type="password" name="password" id="password">
            </div>
            <div class="clearfix"></div>
        </div>

        <input type="hidden" name="remember" value="1">

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

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button tabindex="6" type="submit" class="btn btn-primary">{{ Lang::get('site.submit') }}</button>
            </div>
            <div class="clearfix"></div>
        </div>
    </fieldset>
</form>
@stop
