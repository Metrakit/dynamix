@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.page') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.page') }}}
            <span class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nouveau</span>
        </h1>
        <div class="create-page">
            @foreach( Config::get('display.page-template') as $template)
            <a href="{{ URL::to('admin/page/create?template' . $template)}}" class="page-template {{$template}}"></a>
            @endforeach
        </div>
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