@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.auth_edit_profil') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.auth_edit_profil') }}}</h1>
    </div>
@stop

@section('content')
<div class="col-sm-9">
<form class="form-horizontal" method="POST" action="{{ URL::to('admin/profil/edit' ) }}" accept-charset="UTF-8" autocomplete="off">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>
       	<input type="hidden" name="email" id="email" value="{{{ Input::old('email', $user->email) }}}" disabled="disabled"/>
		<div class="form-group {{{ $errors->has('oldpassword') ? 'error' : '' }}}">
		    <label class="col-sm-2 control-label" for="oldpassword">{{{ Lang::get('auth.oldpassword') }}}</label>
		    <div class="col-sm-10">
		        <input class="form-control" tabindex="5" type="password" name="oldpassword" id="oldpassword" value="" />
		        {{ $errors->first('oldpassword', '<div class="alert alert-danger">:message</div>') }}
		    </div>
		</div>
		<div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
		    <label class="col-sm-2 control-label" for="password">{{{ Lang::get('auth.password') }}}</label>
		    <div class="col-sm-10">
		        <input class="form-control" tabindex="6" type="password" name="password" id="password" value="" />
		        {{ $errors->first('password', '<div class="alert alert-danger">:message</div>') }}
		    </div>
		</div>

		@include('theme::admin.session.session-message')
		<div class="form-group">
		    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
		</div>
    </fieldset>
</form>
</div>
@stop