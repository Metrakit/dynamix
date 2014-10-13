<div class="form-group {{{ $errors->has('pseudo') ? 'error' : '' }}}">
    <label class="col-sm-2 control-label" for="pseudo">{{{ Lang::get('user.pseudo') }}}</label>
    <div class="col-sm-10">
        <input class="form-control" tabindex="1" type="text" name="pseudo" id="pseudo" value="{{{ Input::old('pseudo', $user->pseudo) }}}" />
        {{ $errors->first('pseudo', '<div class="alert alert-danger">:message</div>') }}
    </div>
</div>
<div class="form-group {{{ $errors->has('firstname') ? 'error' : '' }}}">
    <label class="col-sm-2 control-label" for="firstname">{{{ Lang::get('user.firstname') }}}</label>
    <div class="col-sm-10">
        <input class="form-control" tabindex="2" type="text" name="firstname" id="firstname" value="{{{ Input::old('firstname', $user->firstname) }}}" />
        {{ $errors->first('firstname', '<div class="alert alert-danger">:message</div>') }}
    </div>
</div>
<div class="form-group {{{ $errors->has('lastname') ? 'error' : '' }}}">
    <label class="col-sm-2 control-label" for="lastname">{{{ Lang::get('user.lastname') }}}</label>
    <div class="col-sm-10">
        <input class="form-control" tabindex="3" type="text" name="lastname" id="lastname" value="{{{ Input::old('lastname', $user->lastname) }}}" />
        {{ $errors->first('lastname', '<div class="alert alert-danger">:message</div>') }}
    </div>
</div>
<div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
    <label class="col-sm-2 control-label" for="email">{{{ Lang::get('user.email') }}}</label>
    <div class="col-sm-10">
        <input class="form-control" tabindex="4" type="text" name="email" id="email" value="{{{ Input::old('email', $user->email) }}}" />
        {{ $errors->first('email', '<div class="alert alert-danger">:message</div>') }}
    </div>
</div>
<div class="form-group {{{ $errors->has('oldpassword') ? 'error' : '' }}}">
    <label class="col-sm-2 control-label" for="oldpassword">{{{ Lang::get('user.oldpassword') }}}</label>
    <div class="col-sm-10">
        <input class="form-control" tabindex="5" type="password" name="oldpassword" id="oldpassword" value="" />
        {{ $errors->first('oldpassword', '<div class="alert alert-danger">:message</div>') }}
    </div>
</div>
<div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
    <label class="col-sm-2 control-label" for="password">{{{ Lang::get('user.password') }}}</label>
    <div class="col-sm-10">
        <input class="form-control" tabindex="6" type="password" name="password" id="password" value="" />
        {{ $errors->first('password', '<div class="alert alert-danger">:message</div>') }}
    </div>
</div>
<div class="form-group {{{ $errors->has('lang') ? 'error' : '' }}}">
    @foreach( $langsBackend as $lang ) 
      <label class="label-list">
        <span>
            <img height="19px" src="{{$lang['flag']}}" alt="{{$lang['id']}}"/>
            {{$lang['name_locale']}} ({{$lang['name_en']}})
        </span>
        <input type="radio" name="favourite_lang" class="ios-switch" value="{{$lang['id']}}"{{( $user->favourite_lang == $lang['id'] ? ' checked="checked"' : '' )}}>
      </label>
    @endforeach              
</div>


@include('includes.session-message')
<div class="form-group">
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
</div>