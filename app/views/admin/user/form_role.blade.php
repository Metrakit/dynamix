<div class="row">
    @include('admin.user.role', array('roles'=> $roles, 'user'=> $user))
    <div class="clearfix"></div> 
    {{ $errors->first('role', '<div class="alert alert-danger">:message</div>') }}
</div>
@include('includes.session-message')
<div class="form-group">
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
</div>