<div class="col-lg-5 col-md-8 col-sm-12">
<div class="form-group  {{{ $errors->has('role') ? 'error' : '' }}}">
@foreach( $roles as $role)
    <div class="switch">
        <div class="text-capitalize switch-label">
        	<span class="">{{$role->name}}</span>
        </div>
        <div class="switch-button">
        	<input type="checkbox" id="{{$role->name}}switch{{$role->id}}" name="role_{{$role->id}}" class="cmn-toggle cmn-toggle-round-flat" value="{{$role->id}}"{{( $user->hasRole($role->name) && !isset($autocompletion) ? 'checked="checked"' : '' )}}>
        	<label for="{{$role->name}}switch{{$role->id}}" class="label-list"></label>
        </div>
        <div class="clearfix"></div>
      </label>
@endforeach
</div>
</div>