<div class="form-group {{{ $errors->has('pseudo') ? 'error' : '' }}}">
    <label class="col-sm-2 control-label" for="pseudo">{{{ Lang::get('user.pseudo') }}}</label>
    <div class="col-sm-10">
        <input class="form-control" type="text" name="pseudo" id="pseudo" value="{{{ Input::old('pseudo') }}}" />
        {{ $errors->first('pseudo', '<div class="alert alert-danger">:message</div>') }}
    </div>
</div>
<div class="form-group {{{ $errors->has('firstname') ? 'error' : '' }}}">
    <label class="col-sm-2 control-label" for="firstname">{{{ Lang::get('user.firstname') }}}</label>
    <div class="col-sm-10">
        <input class="form-control" type="text" name="firstname" id="firstname" value="{{{ Input::old('firstname') }}}" />
        {{ $errors->first('firstname', '<div class="alert alert-danger">:message</div>') }}
    </div>
</div>
<div class="form-group {{{ $errors->has('lastname') ? 'error' : '' }}}">
    <label class="col-sm-2 control-label" for="lastname">{{{ Lang::get('user.lastname') }}}</label>
    <div class="col-sm-10">
        <input class="form-control" type="text" name="lastname" id="lastname" value="{{{ Input::old('lastname') }}}" />
        {{ $errors->first('lastname', '<div class="alert alert-danger">:message</div>') }}
    </div>
</div>
<div>
    <label class="col-sm-2 control-label" for="lastname">{{{ Lang::get('admin.role') }}}</label>
    <div class="col-sm-10">
        @include('admin.user.role', array('autocompletion'=>false))
        <div class="clearfix"></div>
    </div>
</div>
<div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
    <label class="col-sm-2 control-label" for="email">{{{ Lang::get('user.email') }}}</label>
    <div class="col-sm-10">
        <input class="form-control" type="email" name="email" id="email" value="{{{ Input::old('email') }}}" />
        {{ $errors->first('email', '<div class="alert alert-danger">:message</div>') }}
    </div>
</div>
<div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
    <label class="col-sm-2 control-label" for="password">{{{ Lang::get('user.password') }}}</label>
    <div class="col-sm-10">
        <input class="form-control" type="password" name="password" id="password" value="" />
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
        <input type="radio" name="favourite_lang" class="ios-switch" value="{{$lang['id']}}"{{( $lang['enable'] == 1 ? ' checked="checked"' : '' )}}>
      </label>
    @endforeach              
</div>
@include('includes.session-message')
<div class="form-group">
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
</div>