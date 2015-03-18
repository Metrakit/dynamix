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
@foreach( $reroutes as $reroute) 
    <form class="form-horizontal" method="post" action="{{ URL::to('admin/rerouter') }}"  autocomplete="off">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <fieldset>
        <div class="col-md-10">
            <!-- url_referer -->
            <div class="form-group {{{ $errors->has('url_referer') ? 'error' : '' }}} col-md-6">
                <label class="col-md-2 control-label" for="url_referer">{{{ Lang::get('admin.rerouter_url_referer') }}}</label>
                <div class="col-md-10 col-lg-8">
                    <input class="form-control" type="text" name="url_referer" id="url_referer" value="{{{ Input::old('url_referer', $reroute->url_referer) }}}" />
                    {{ $errors->first('url_referer', '<div class="alert alert-danger">:message</div>') }}
                </div>
            </div>
            <!-- ./ url_referer -->

                <!-- url_redirect -->
            <div class="form-group {{{ $errors->has('url_redirect') ? 'error' : '' }}} col-md-6">
                <label class="col-md-2 control-label" for="url_redirect">{{{ Lang::get('admin.rerouter_url_redirect') }}}</label>
                <div class="col-md-10 col-lg-8">
                    <input class="form-control" type="text" name="url_redirect" id="url_redirect" value="{{{ Input::old('url_redirect', $reroute->url_redirect) }}}" />
                    {{ $errors->first('url_redirect', '<div class="alert alert-danger">:message</div>') }}
                </div>
            </div>
            <!-- ./ url_redirect -->
            <div class="clearfix">
        </div>
        <div class="col-md-10">
            <!-- Form Actions -->
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10 col-lg-8">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> {{{Lang::get('button.update')}}}</button>
                </div>
            </div>
            <!-- ./ form actions -->
        </div>
        <div class="clearfix">
        </fieldset>

    </form>
@endforeach
</div>
@stop