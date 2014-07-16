@extends('site.layout.master')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.login') }}} |
@parent
@stop

{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ asset( 'user/login' ) }}">Connexion</a>
@stop


{{-- Content --}}
@section('content')
<div class="page-header">
    <h1>{{{ Lang::get('site.login')}}}</h1>
</div>
<form class="form-horizontal" method="POST" action="{{ URL::to('user/login') }}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="email">{{ Lang::get('user/user.email') }}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="1" placeholder="{{ Lang::get('user/user.email') }}" type="text" name="email" id="email" value="{{ Input::old('email', Session::get('email') ) }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="password">
                {{ Lang::get('user/user.password') }}
            </label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="2" placeholder="{{ Lang::get('user/user.password') }}" type="password" name="password" id="password">
            </div>
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
                <button tabindex="3" type="submit" class="btn btn-primary">{{ Lang::get('site.submit') }}</button>
                <a class="btn btn-default" href="forgot">{{ Lang::get('user/user.forgot_password') }}</a>
            </div>
        </div>
    </fieldset>
</form>
@stop