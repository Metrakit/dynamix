<div class="col-lg-5 col-md-8 col-sm-12">
<div class="form-group  {{{ $errors->has('role') ? 'error' : '' }}}">
@foreach( $roles as $role)
      <label class="label-list">
        <span class="">{{$role->name}}</span>
        <input type="checkbox" name="role_{{$role->id}}" class="ios-switch" value="{{$role->id}}"{{( $user->hasRole($role->name) && !isset($autocompletion) ? 'checked="checked"' : '' )}}>
      </label>
@endforeach
</div>
</div>