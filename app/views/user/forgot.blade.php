@extends('site.layout.master')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.forgot_password') }}} |
@parent
@stop

{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ asset( 'user/forgot' ) }}">Mot de passe oublié</a>
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1>{{{ Lang::get('user/user.forgot_password') }}}</h1>
</div>
<form class="form-horizontal" method="POST" action="{{ URL::to('user/forgot') }}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>
    	<div class="form-group">
    		{{ Lang::get('user/user.forgot_password_message') }}
    	</div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="email">{{ Lang::get('user/user.email') }}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="4" placeholder="{{ Lang::get('user/user.email') }}" type="text" name="email" id="email" value="{{ Input::old('email') }}">
            </div>
        </div>

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
            </div>
        </div>
    </fieldset>
</form>
@stop
