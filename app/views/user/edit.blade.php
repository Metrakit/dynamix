@extends('public.layout.master')


@section('meta_title')
{{{ Lang::get('user.edit_account') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ asset( 'user/' . $user->id . '/edit' ) }}">{{{ Lang::get('user.edit_account') }}}</a>
@stop


@section('content')
<div class="page-header">
	<h1>{{{ Lang::get('user.edit_account')}}}</h1>
</div>
<form class="form-horizontal" method="post" action="{{ URL::to('user/'.$user->id) }}"  autocomplete="off">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <input type="hidden" name="_method" value="put" />
    <fieldset>
        <!-- pseudo -->
        <div class="form-group {{{ $errors->has('pseudo') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="pseudo">{{{ Lang::get('user.pseudo') }}}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="1" type="text" name="pseudo" id="pseudo" value="{{{ Input::old('pseudo', $user->pseudo) }}}" />
                {{ $errors->first('pseudo', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ pseudo -->

        <!-- firstname -->
        <div class="form-group {{{ $errors->has('firstname') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="firstname">{{{ Lang::get('user.firstname') }}}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="2" type="text" name="firstname" id="firstname" value="{{{ Input::old('firstname', $user->firstname) }}}" />
                {{ $errors->first('firstname', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ firstname -->

        <!-- lastname -->
        <div class="form-group {{{ $errors->has('lastname') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="lastname">{{{ Lang::get('user.lastname') }}}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="3" type="text" name="lastname" id="lastname" value="{{{ Input::old('lastname', $user->lastname) }}}" />
                {{ $errors->first('lastname', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ lastname -->

        <!-- Email -->
        <div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="email">{{{ Lang::get('user.email') }}}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="4" type="text" name="email" id="email" value="{{{ Input::old('email', $user->email) }}}" />
                {{ $errors->first('email', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ email -->

        <!-- Password -->
        <div class="form-group {{{ $errors->has('oldpassword') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="oldpassword">{{{ Lang::get('user.oldpassword') }}}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="5" type="password" name="oldpassword" id="oldpassword" value="" />
                {{ $errors->first('oldpassword', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ password -->

        <!-- Password -->
        <div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="password">{{{ Lang::get('user.password') }}}</label>
            <div class="col-sm-10">
                <input class="form-control" tabindex="6" type="password" name="password" id="password" value="" />
                {{ $errors->first('password', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ password -->
    
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

        <!-- Form Actions -->
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" tabindex="7" class="btn btn-success">{{{ Lang::get('public.update') }}}</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </fieldset>

</form>
@stop
