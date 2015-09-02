@extends('theme::public.layout.master')


@section('meta_title')
{{{ I18n::get('auth.login') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ URL::route('admin.login') }}">{{{ I18n::get('auth.connexion') }}}</a>
@stop


@section('content')
<div class="page-header">
    <h1>{{{ I18n::get('auth.login') }}}</h1>
</div>
<form class="form-horizontal" method="POST" action="{{ URL::route('admin.login.post') }}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>
        <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
            <label class="col-sm-2 control-label" for="email">{{{ I18n::get('auth.email') }}}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="1" placeholder="{{ I18n::get('auth.email') }}" type="text" name="email" id="email" value="{{ Input::old('email', Session::get('email') ) }}">
                {{ $errors->first('email', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
            <label class="col-sm-2 control-label" for="password">
                {{{ I18n::get('auth.password') }}}
            </label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="2" placeholder="{{ I18n::get('auth.password') }}" type="password" name="password" id="password">
                {{ $errors->first('password', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>

        <input type="hidden" name="remember" value="1">

        @if ( Session::has('error') )
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
        @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('success') }}
        </div>
        @endif

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button tabindex="3" type="submit" class="btn btn-primary">{{{ Lang::get('public.validate') }}}</button>
                <a class="btn btn-default" href="{{URL::route('reminder')}}">{{{ I18n::get('auth.forgot_password') }}}</a>
            </div>
        </div>
    </fieldset>
</form>
@stop