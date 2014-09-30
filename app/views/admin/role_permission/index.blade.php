@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.role_permission') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.role_permission') }}}</h1>
    </div>
@stop

@section('content')

@include('includes.session-message')

<h2>{{{ Lang::get('admin.roles') }}} <a href="{{ URL::to('admin/role/create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> {{{ Lang::get('button.new') }}}</a></h2>
<div class="col-sm-6">
<table class="table">
    <thead>
    <tr>
        <th>{{{ Lang::get('admin.role_name') }}}</th>
        <th><span class="pull-right">{{{ Lang::get('table.actions') }}}</span></th>
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
    <tr>
        <td>{{$role->name}}</td>
        <td>
        	@if ( $role->isDeletable() )
	        {{ Form::open(array('url' => 'admin/role/' . $role->id, 'class' => 'pull-right')) }}
				{{ Form::hidden('_method', 'DELETE') }}
				<button type="submit" class="btn btn-danger remove"><span class="glyphicon glyphicon-remove"></span></button>
			{{ Form::close() }}
			@endif
            <a href="{{URL::to('admin/role/'.$role->id.'/edit')}}" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-pencil"></span></a>
			<div class="clearfix"></div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
<div class="clearfix"></div>


<h2>{{{ Lang::get('admin.permissions') }}}</h2>
<table class="table">
    <thead>
    <tr>
        <th>{{{ Lang::get('admin.role') }}}</th>
        @foreach( App::make('CacheController')->getCache('DB_AdminResourceName') as $resource )
            <th>{{{ Lang::get('admin.'.$resource) }}}</th>
        @endforeach
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
    <tr>
        <form class="form-horizontal" method="POST" action="{{ URL::to('admin/permission') }}" accept-charset="UTF-8" autocomplete="off">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="role_id" value="{{ $role->id }}">

            <th>{{ $role->name }}</th>
            @foreach( App::make('CacheController')->getCache('DB_AdminResourceName') as $k => $resource )
                <td>
                    <div class="checkbox">
                        <label>
                            <input name="{{$k}}" value="{{$k}}" type="checkbox"{{( $role->hasResource($k) ? 'checked="checked"' : '' )}}>
                        </label>
                    </div>
                </td>
            @endforeach
            <td>
             <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-ok"></span> {{{ Lang::get('button.update') }}}</button>
            </td>
        </form>
    </tr>
    @endforeach
    </tbody>
</table>

@stop