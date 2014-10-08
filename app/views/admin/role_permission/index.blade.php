@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.role_permission') }}} |
@parent
@stop

@section('scriptOnReady')
masterAdminClass.checboxButtonListener();
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.role_permission') }}}
            <a href="{{ URL::to('admin/role/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nouveau</a>
        </h1>
    </div>
@stop

@section('content')

@include('includes.session-message')
@include('includes.session-message-var', array('var'=>'permissions'))

<h2>{{{ Lang::get('admin.manage_access_resource') }}}</h2>
<div class="alert alert-info" role="alert">{{{ Lang::get('admin.role_help') }}}{{{ Lang::get('admin.permission_help') }}}</div>

<div class="row">
<?php
    $i = 0;
?>
    @foreach($roles as $role)
    {{($i==0?'':'<hr>')}}
    <?php
        $i++;
    ?>
    <section class="role">
        <div class="row">
        <div class="col-md-2 col-sm-12">
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
        </div>
        <form class="form-horizontal form-role_permission col-sm-12 col-md-10" method="POST" action="{{ URL::to('admin/permission') }}" accept-charset="UTF-8" autocomplete="off">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="role_id" value="{{ $role->id }}">
            <div class="row">
            <div class="col-md-12 col-lg-9">
                @foreach( App::make('CacheController')->getCache('DB_AdminResource') as $resource )
                    <div class="col-md-3 col-sm-6 col-xs-12">                    
                        <div class="checkbox checkbox-button">
                            <label>
                                <input name="{{$resource->id}}" value="{{$resource->id}}" type="checkbox"{{( $role->hasResource($resource->id) ? ' checked="checked" class="enable"' : ' class="disable"' )}}>
                                <span class="text-capitalize text-left">
                                    <span class="{{$resource->icon}}"></span> {{{ Lang::get('admin.'.$resource->name) }}}
                                </span>
                            </label>
                        </div>
                    </div>
                @endforeach
                    <div class="clearfix"></div>
            </div>
            <div class="col-md-12 col-lg-3">
                <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-ok"></span> {{{ Lang::get('button.update') }}}</button>
            </div>
            </div>
        </form>
        <div class="clearfix"></div>
        </div>
    </section>
    @endforeach

</div>
    
    </tbody>
</table>

@stop