@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.navigation_create22') }}} |
@parent
@stop


@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.navigation_create22') }}}
    </div>
@stop

@section('content')
@include('theme::admin.session.session-message')

<div class="col-sm-9">

    @if (!empty($resource_not_allowed))
    <form class="form-horizontal" method="POST" action="{{ URL::to('admin/navigation') }}" accept-charset="UTF-8" autocomplete="off">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
            @include('theme::admin.navigation.form')
        </fieldset>
    </form>

    @else
    
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Pour créer un menu ou un sous-menu, vous devez d'abord créer une resource.<br>
    </div>
    <!-- Boutons vers la page de création des ressources genre Créer une page, gallery... -->
    <a href="{{URL::to('admin/page/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Page</a>
    <a href="{{URL::to('admin/gallery/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Galerie</a>

    @endif

</div>
@stop