@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.user_edit_role') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.user_edit_role') }}}</h1>
    </div>
@stop

@section('content')
{{var_dump(Session::all())}}
<div class="col-sm-9">
<form class="form-horizontal" method="POST" action="{{ URL::to('admin/role/' . $u->id ) }}" accept-charset="UTF-8" autocomplete="off">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="img-center col-lg-5 col-md-8 col-sm-12">
		<img class="img-circle img-responsive" height="256px" width="256px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $u->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=256px"}}" alt="gravatar" />
	</div>
	<div class="clearfix"></div>
    <fieldset>
        <div class="row">
            @include('theme::admin.auth.role', array('roles'=> $roles, 'user'=> $u))
            <div class="clearfix"></div> 
            {{ $errors->first('role', '<div class="alert alert-danger">:message</div>') }}
        </div>
        @include('theme::admin.session.session-message')
        <div class="form-group col-lg-5 col-md-8 col-sm-12 text-center">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-{{ $glyphicon }}"></span> {{ $buttonLabel }}</button>
        </div>
    </fieldset>
</form>
</div>
@stop