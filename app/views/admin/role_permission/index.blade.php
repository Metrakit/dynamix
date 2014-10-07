@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.role_permission') }}} |
@parent
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

<h2>{{{ Lang::get('admin.roles') }}}</h2>
<p class="help-block">{{{ Lang::get('admin.role_help') }}}</p>
<h2>{{{ Lang::get('admin.permissions') }}}</h2>
<p class="help-block">{{{ Lang::get('admin.permission_help') }}}</p>
<div class="row">

    @foreach($roles as $role)
    <section class="role">
        <form class="form-horizontal" method="POST" action="{{ URL::to('admin/permission') }}" accept-charset="UTF-8" autocomplete="off">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="role_id" value="{{ $role->id }}">
            <div class="col-md-2 col-sm-4">
                <div class="text-center">
                    <h3 class="text-capitalize">{{ $role->name }}</h3>
                </div>
                <div>
                    @if ( $role->isDeletable() )
                    {{ Form::open(array('url' => 'admin/role/' . $role->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        <button type="submit" class="btn btn-danger remove"><span class="glyphicon glyphicon-remove"></span></button>
                    {{ Form::close() }}
                    @endif
                    <a href="{{URL::to('admin/role/'.$role->id.'/edit')}}" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-pencil"></span></a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-sm-8 col-md-10 col-lg-8">
                @foreach( App::make('CacheController')->getCache('DB_AdminResource') as $resource )
                    <div class="col-md-3 col-sm-4 col-xs-4">
                    <h4 class="text-capitalize"><span class="{{$resource->icon}}"></span> {{{ Lang::get('admin.'.$resource->name) }}}</h4>
                    <div class="checkbox">
                        <label>
                            <input name="{{$resource->id}}" value="{{$resource->id}}" type="checkbox"{{( $role->hasResource($resource->id) ? 'checked="checked"' : '' )}}>
                        </label>
                    </div>
                    </div>
                @endforeach
                    <!-- <div class="clearfix"></div>> -->
            </div>
            <div class="col-md-12 col-lg-2">
                <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-ok"></span> {{{ Lang::get('button.update') }}}</button>
            </div>
            <div class="clearfix"></div>
        </form>
    </section>
    @endforeach

</div>
    
    </tbody>
</table>

@stop