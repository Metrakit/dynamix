@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.logs') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.logs') }}}</h1>
    </div>
@stop

@section('content')
<div class="row">
@if ( count($logs) == 0 )
<h2 class="text-center">{{{ Lang::get('admin.noItemToSHow') }}}</h2>
@else
<table class="table table-hover">
<thead>
    <tr>
        <th>{{ Lang::get('admin.user') }}</th>
        <th>{{ Lang::get('table.date') }}</th>
        <th>{{ Lang::get('table.action') }}</th>
        <th>{{ Lang::get('table.resource') }}</th>
    </tr>
</thead>
<tbody>
@foreach ($logs as $log)
    <tr class="{{ Config::get('core.log.action_css')[$log->action] }}">
        <td><span class="text-capitalize">{{ $log->userName() }}</span></td>
        <td>{{ $log->date }}</td>
        <td>{{{ Lang::get('admin.log_'.$log->action) }}}</td>
        <td>{{{ Lang::get('admin.rsc'.$log->trackable_type) }}}</td>
    </tr>
@endforeach
</tbody>
</table>
@endif
{{ $logs->links() }}
</div>
@stop