@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin/admin.gallery_create') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<a href="{{URL::to('admin')}}">{{{ Lang::get('admin/admin.dashboard') }}}</a>&nbsp;
<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/gallery')}}">{{{ Lang::get('admin/admin.gallery') }}}</a>
<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/gallery/create')}}">{{{ Lang::get('admin/admin.gallery_create') }}}</a>
@stop


@section('content')
<h2>{{{ Lang::get('admin/admin.gallery_create') }}}</h2>

<div class="col-sm-9">
<form class="form-horizontal" method="POST" action="{{ URL::to('admin/gallery') }}" accept-charset="UTF-8" autocomplete="off">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>
        @include('admin.gallery.form')

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

        <div class="form-group">
            <button tabindex="6" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Créer la galerie</button>
        </div>
    </fieldset>
</form>
</div>
@stop


@section('scriptOnReady')
$('.iframe-btn').fancybox({
    width   : 880,
    height  : '750px',
    type    : 'iframe',
    autoScale   : false
});
@stop