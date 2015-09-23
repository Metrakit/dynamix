<div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
    <label class="control-label" for="name">{{{ Lang::get('input.name') }}}</label>
    <input class="form-control" type="text" name="name" id="name" value="{{{ Input::old('name', (isset($role) ? $role->name : '')) }}}" />
    {{ $errors->first('name', '<div class="alert alert-danger">:message</div>') }}
</div>
@include('theme::admin.session.session-message')
<div class="form-group">
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
</div>