@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.page_create') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.page_create') }}}</h1>
    </div>
@stop


@section('content')

@include('includes.session-message')

<div>
{{ Form::open(array('url' => URL::to('admin/page'), 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off' ) ) }}
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

        @yield('form')
        
        <!-- ./ form actions -->
{{ Form::close() }}
</div>

@stop