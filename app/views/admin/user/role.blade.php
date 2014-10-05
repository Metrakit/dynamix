@foreach( $roles as $role)
<div class="col-lg-4 col-sm-6">
<div class="form-group  {{{ $errors->has('role') ? 'error' : '' }}}">
    <div class="checkbox">
      <label>
        <input type="checkbox" name="role_{{$role->id}}" value="{{$role->id}}"{{( $user->hasRole($role->name) && !isset($autocompletion) ? 'checked="checked"' : '' )}}>
        {{$role->name}}
      </label>
    </div>
</div>
</div>
@endforeach