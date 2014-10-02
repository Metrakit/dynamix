<div class="form-group {{{ $errors->has('role') ? 'error' : '' }}}">
    <label class="col-sm-2 control-label" for="role">{{{ Lang::get('user.role') }}}</label>
    <div class="col-sm-10">
        <input class="form-control" tabindex="1" type="text" name="role" id="role" value="{{{ Input::old('role', $user->role) }}}" />
        {{ $errors->first('role', '<div class="alert alert-danger">:message</div>') }}
    </div>
</div>
@include('includes.session-message')
<div class="form-group">
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
</div>