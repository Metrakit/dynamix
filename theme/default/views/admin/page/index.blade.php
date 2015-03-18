@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.page') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.page') }}}
            <span class="btn btn-primary" data-toggle="collapse" data-target="#page-template"><span class="glyphicon glyphicon-plus"></span> Nouveau</span><br>
        </h1>
        <div class="create-page collapse" id="page-template">
            <h4>Choisissez un modèle de page</h4>
            <div class="text-center">
                @foreach( Config::get('display.page-template') as $template)
                <a href="{{ URL::to('admin/page/create?template=' . $template)}}" class="page-template {{$template}}"></a>
                @endforeach
            </div>
        </div>
    </div>
@stop


@section('content')
<!-- Colonne gauche -->
<div class="row">
    @include('theme::admin.session.session-message')

    @foreach($pages as $page)
    <div class="col-lg-4">
        @include('theme::admin.page.presenter', array('page'=>$page, 'showButton'=>true))
    </div>
    @endforeach
</div>

@stop