@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.tags') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.tags') }}}
         <a href="{{URL::to('admin/tag/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> {{{ Lang::get('button.new') }}}</a></h1>
    </div>
@stop

@section('content')
@include('theme::admin.session.session-message')

<div class="alert alert-info" role="alert">{{{ Lang::get('admin.role_help') }}}{{{ Lang::get('admin.permission_help') }}}</div>

    <section class="tags">
        @foreach($langsFrontEnd as $lang)
            @include('theme::admin.tag.presenter_manager', array('lang' => $lang))
        @endforeach
    </section>
@stop