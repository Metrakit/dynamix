@extends('admin.layout.master')


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
@include('includes.session-message')

<div class="alert alert-info" role="alert">{{{ Lang::get('admin.role_help') }}}{{{ Lang::get('admin.permission_help') }}}</div>

    <section class="tags">
        @foreach($langsFrontEnd as $lang)
        <section class="tag">
            <h2 class="text-capitalize">{{ $lang->name_locale }}</h2>
            @foreach($lang->tags() as $tag)
            <span class="tag-king-blue">
                <div class="btn-absolute">
                    {{ Form::open(array('url' => 'admin/tag/' . $tag->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        <button type="submit" class="btn btn-transparent-white btn-xs remove"><span class="glyphicon glyphicon-remove"></span></button>
                    {{ Form::close() }}
                    <div class="pull-right"><a href="{{URL::to('admin/tag/' . $tag->id . '/edit')}}" class="btn btn-xs btn-transparent-white pencil"><span class="glyphicon glyphicon-pencil"></span></a></div>
                    <div class="clearfix"></div>
                </div>
                <span class="glyphicon glyphicon-tag"></span> <span>{{$tag->text}}</span>
            </span>
            @endforeach
        </section>
        @endforeach
    </section>
@stop