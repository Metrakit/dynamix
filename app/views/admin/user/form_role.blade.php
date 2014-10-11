<div class="row">
    @include('admin.user.role', array('roles'=> $roles, 'user'=> $u))
    <div class="clearfix"></div> 
    {{ $errors->first('role', '<div class="alert alert-danger">:message</div>') }}
</div>
@include('includes.session-message')
<div class="form-group col-lg-5 col-md-8 col-sm-12 text-center">
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
</div>