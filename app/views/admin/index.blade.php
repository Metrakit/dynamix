@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.dashboard') }}} |
@parent
@stop


@section('content')
    @include('includes.session-message')

    <div class="col-sm-3">
        
    </div>
@stop