@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.user_edit_role') }}} |
@parent
@stop

@section('script')
masterAdminClass.switchCheckboxInitializr();
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.user_edit_role') }}}</h1>
    </div>
@stop

@section('content')
<div class="col-sm-9">
<form class="form-horizontal" method="POST" action="{{ URL::to('admin/user/' . $u->id ) }}" accept-charset="UTF-8" autocomplete="off">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="put">
    <div class="img-center col-lg-5 col-md-8 col-sm-12">
		<img class="img-circle img-responsive" height="256px" width="256px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $u->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=256px"}}" alt="gravatar" />
	</div>
	<div class="clearfix"></div>
    <fieldset>
        @include('admin.user.form_role')
    </fieldset>
</form>
</div>
@stop