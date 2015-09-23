@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.role_permission') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.role_permission') }}}
            <a href="{{ URL::to('admin/role/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> {{{Lang::get('button.new')}}}</a>
        </h1>
    </div>
@stop

@section('content')

@include('theme::admin.session.session-message')
@include('theme::admin.session.session-message-var', array('var'=>'permissions'))

<h2>{{{ Lang::get('admin.manage_access_resource') }}}</h2>
<div class="alert alert-info" role="alert">{{{ Lang::get('admin.role_help') }}}{{{ Lang::get('admin.permission_help') }}}</div>

<div class="row">
    @foreach($roles as $role)
    <section class="role col-lg-5 col-md-6">
            <div class="text-left">
                <h3 class="text-capitalize">{{ $role->name }}
                <a href="{{URL::to('admin/role/'.$role->id.'/edit')}}" class="btn btn-xs btn-default inline-block"><span class="glyphicon glyphicon-pencil"></span></a>
                @if ( $role->isDeletable() )
                {{ Form::open(array('url' => 'admin/role/' . $role->id, 'class' => 'inline-block')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    <button type="submit" class="btn btn-xs btn-default remove"><span class="glyphicon glyphicon-remove"></span></button>
                {{ Form::close() }}
                @endif
                </h3>
            </div>
            <form class="form-horizontal form-role_permission" method="POST" action="{{ URL::to('admin/permission') }}" accept-charset="UTF-8" autocomplete="off">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="role_id" value="{{ $role->id }}">
                    @foreach( Cachr::getCache('DB_AdminResource') as $resource )
                    <div class="switch">
                        <div class="text-capitalize switch-label">
                            <span class="{{$resource->icon}}"></span> {{{ Lang::get('admin.'.$resource->name) }}}
                        </div>
                        <div class="switch-button">
                            <input id="{{$role->name}}switch{{$resource->id}}" name="{{$resource->id}}" value="{{$resource->id}}" class="cmn-toggle cmn-toggle-round-flat" type="checkbox"{{( $role->hasResource($resource->id) ? ' checked="checked"' : '' )}}>
                            <label for="{{$role->name}}switch{{$resource->id}}" class="label-list"></label>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @endforeach
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> {{{ Lang::get('button.update') }}}</button>
                    </div>
            </form>
    </section>
    @endforeach
    <div class="clearfix"></div>
</div>
@stop