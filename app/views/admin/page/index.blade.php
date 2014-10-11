@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.page') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.page') }}}
            <a href="{{ URL::to('admin/page/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nouveau</a>
        </h1>
    </div>
@stop


@section('content')
<!-- Colonne gauche -->
<div class="row">
    @include('includes.session-message')

    @foreach($pages as $page)
    <div class="col-lg-4">
        @include('admin.page.presenter', array('page'=>$page, 'showButton'=>true))
    </div>
    @endforeach
</div>

@stop