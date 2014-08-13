@extends('site.layout.master')


@section('meta_title')
Réinitialisation du mot de passe |
@parent
@stop

@section('ariane')
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>Réinitialisation du mot de passe</h3>
</div>
<form class="form-horizontal" method="post" action="{{ action('RemindersController@postReset') }}"  autocomplete="off">
    <input type="hidden" name="token" value="{{ $token }}">
    <fieldset>

        <!-- Email -->
        <div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="email">{{{Lang::get('user/user.email')}}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="email" id="email" value="{{{ Input::old('email') }}}" />
                {{ $errors->first('email', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ email -->

        <!-- Password -->
        <div class="form-group {{{ $errors->has('oldpassword') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="oldpassword">{{{Lang::get('user/user.newpassword')}}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="password" name="password" id="password" value="" />
                {{ $errors->first('oldpassword', '<div class="alert alert-danger">:message</div>') }}
            </div>
        </div>
        <!-- ./ password -->

        <!-- Password -->
        <div class="form-group {{{ $errors->has('password_confirmation') ? 'error' : '' }}}">
            <label class="col-sm-2 control-label" for="password_confirmation">{{{Lang::get('user/user.password_confirmation')}}}</label>
            <div class="col-sm-10">
                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="" />
                {{ $errors->first('password_confirmation', '<div class="alert alert-danger">:message</div>') }}
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
                <button type="submit" class="btn btn-success">Valider</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </fieldset>

</form>
@stop
