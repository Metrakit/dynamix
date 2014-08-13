@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin/admin.page') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<a href="{{URL::to('admin')}}">{{{ Lang::get('admin/admin.dashboard') }}}</a>&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/page')}}">{{{ Lang::get('admin/admin.page') }}}</a>
@stop


@section('content')
<h2>{{{ Lang::get('admin/admin.page') }}}</h2>

<!-- Colonne gauche -->
<div class="col-sm-12">

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

    <table class="table">
        <tr>
            <th>Titre</th>
            <th>URL</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        @foreach($pages as $page)
        <tr>
            <td>{{ $page->title }}</td>
            <td>{{ URL::to($page->url) }}</td>
            <td>{{ $page->meta_description }}</td>
            <td>
                {{ Form::open(array('url' => 'admin/page/' . $page->id, 'class' => 'inlineImportant' )) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    <div class="btn-group">
                    <a href="{{ URL::to('admin/page/' . $page->id . '/edit') }}" class="btn btn-primary" title="Modifier la page">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                @if($page->is_deletable)
                    <button type="submit" class="btn btn-danger remove"><span class="glyphicon glyphicon-trash"></span></button>
                @endif
                    </div>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
    </table>

</div>
<div class="clearfix"></div>
@stop