@extends('site.layout.master')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.settings') }}} |
@parent
@stop

{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ asset( 'user/' . $user->id . '/edit' ) }}">Modifier profil</a>
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>{{{Lang::get('user/user.edit_your_settings')}}}</h3>
</div>
<form class="form-horizontal" method="post" action="{{ URL::to('user/'.$user->id) }}"  autocomplete="off">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <input type="hidden" name="_method" value="put" />
    <fieldset>
        <!-- pseudo -->
        <div class="form-group {{{ $errors->has('pseudo') ? 'error' : '' }}}">
            <div class="col-sm-2 center"><a href="https://fr.gravatar.com/"><img src="http://www.gravatar.com/avatar/{{ md5( strtolower( trim( $user->email ) ) ) }}" alt="Gravatar"></a></div>
            <div class="col-sm-10 form-group">
                <label class="control-label" for="pseudo">{{{Lang::get('user/user.pseudo')}}}</label>
                <input class="form-control" type="text" name="pseudo" id="pseudo" value="{{{ Input::old('pseudo', $user->pseudo) }}}" />
                {{ $errors->first('pseudo', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ pseudo -->

        <!-- firstname -->
        <div class="form-group {{{ $errors->has('firstname') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="firstname">{{{Lang::get('user/user.firstname')}}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="firstname" id="firstname" value="{{{ Input::old('firstname', $user->firstname()) }}}" />
                {{ $errors->first('firstname', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ firstname -->

        <!-- lastname -->
        <div class="form-group {{{ $errors->has('lastname') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="lastname">{{{Lang::get('user/user.lastname')}}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="lastname" id="lastname" value="{{{ Input::old('lastname', $user->lastname()) }}}" />
                {{ $errors->first('lastname', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ lastname -->

        <!-- Email -->
        <div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="email">{{{Lang::get('user/user.email')}}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="email" id="email" value="{{{ Input::old('email', $user->email) }}}" />
                {{ $errors->first('email', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ email -->

        <!-- Password -->
        <div class="form-group {{{ $errors->has('oldpassword') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="oldpassword">{{{Lang::get('user/user.oldpassword')}}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="password" name="oldpassword" id="oldpassword" value="" />
                {{ $errors->first('oldpassword', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ password -->

        <!-- Password -->
        <div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="password">{{{Lang::get('user/user.password')}}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="password" name="password" id="password" value="" />
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
                <button type="submit" class="btn btn-success">{{{Lang::get('user/user.update')}}}</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </fieldset>

</form>
@stop
