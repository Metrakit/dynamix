@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.navigation_create12') }}} |
@parent
@stop


@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.navigation_create12') }}}
    </div>
@stop

@section('content')
@include('theme::admin.session.session-message')

<div class="col-sm-9">

    <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>
            {{ Lang::get('admin.navigation_create_choose_help') }}
        </p>
    </div>

    <div class="col-sm-4">
        
        <div class="panel panel-default">
            <div class="panel-heading">{{{ Lang::get('admin.navigation_link_internal') }}}</div>
            <div class="panel-body">
                <a href="{{ URL::to('admin/navigation/create?link_internal=1')}}" class="btn btn-primary{{(count($resource_not_allowed)>0?'':' disabled')}}">{{{ Lang::get('admin.navigation_create_link_internal') }}}</a>
            </div>
        </div>
    </div>


    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">{{{ Lang::get('admin.navigation_link_external') }}}</div>
            <div class="panel-body">
                <a href="{{ URL::to('admin/navigation/create?link_external=1')}}" class="btn btn-primary">{{{ Lang::get('admin.navigation_create_link_external') }}}</a>
            </div>
        </div>
        
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">{{{ Lang::get('admin.navigation_button') }}}</div>
            <div class="panel-body">
                <a href="{{ URL::to('admin/navigation/create')}}" class="btn btn-primary">{{{ Lang::get('admin.navigation_create_button') }}}</a>
            </div>
        </div>
        
    </div>
    <div class="clearfix"></div>
    
    @if (count($resource_not_allowed)>0)
    <form class="form-horizontal" method="POST" action="{{ URL::to('admin/navigation') }}" accept-charset="UTF-8" autocomplete="off">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>

        </fieldset>
    </form>
    @else
        @include('theme::admin.resource.presenter_call_to_create')
    @endif

</div>
@stop