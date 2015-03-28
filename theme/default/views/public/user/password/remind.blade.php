@extends('theme::public.layout.master')


@section('meta_title')
{{{ Lang::get('user.forgot_password') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ asset( 'user/forgot' ) }}">{{{ Lang::get('user.forgot_password') }}}</a>
@stop


@section('content')
<div class="page-header">
    <h1>{{{ Lang::get('user.forgot_password') }}}</h1>
</div>
<form class="form-horizontal" method="POST" action="{{ action('RemindersController@postRemind') }}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>
    	<div class="form-group">
    		{{{ Lang::get('user.forgot_password_message') }}}
    	</div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="email">{{{ Lang::get('user.email') }}}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="4" placeholder="{{ Lang::get('user.email') }}" type="text" name="email" id="email" value="{{ Input::old('email') }}">
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
                <button tabindex="3" type="submit" class="btn btn-primary">{{{ Lang::get('user.ask_new_password') }}}</button>
            </div>
        </div>
    </fieldset>
</form>
@stop
