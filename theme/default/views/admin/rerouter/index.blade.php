@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.rerouter') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.rerouter') }}}</h1>
    </div>
@stop

@section('content')
    <div class="row">

    @include('theme::admin.session.session-message')

    <div class="col-md-6 text-center">
        {{{ Lang::get('admin.rerouter_url_referer') }}}
    </div>
    <div class="col-md-6 text-center">
        {{{ Lang::get('admin.rerouter_url_redirect') }}}
    </div>
    <div class="clearfix"></div>

    @include('theme::admin.rerouter.form', array('glyphicon' => 'plus'))

    @foreach( $reroutes as $reroute) 
        @include('theme::admin.rerouter.form', array('reroute' => $reroute, 'glyphicon' => 'check'))
    @endforeach
    </div>
@stop