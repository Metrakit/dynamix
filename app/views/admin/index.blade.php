@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin/admin.dashboard') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<a href="{{URL::to('admin')}}">{{{ Lang::get('admin/admin.dashboard') }}}</a>
@stop



@section('content')
    <h1>Hello {{ $user->firstname }},</h1>
    <h2>{{{ Lang::get('admin/admin.dashboard') }}}</h2>

    <div class="col-sm-3">
        <h3>Google Analytics</h3>
        <a href="http://www.google.com/analytics/">
            <img src="{{asset('img/google-analytics-icon.png')}}" alt="g-analytics" width="100%"/>
        </a>
    </div>

    @if ( Session::get('error') )
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error') }}
    </div>
    @endif
    @if ( Session::get('notice') )
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('notice') }}
    </div>
    @endif
    @if ( Session::get('success') )
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('success') }}
    </div>
    @endif
@stop