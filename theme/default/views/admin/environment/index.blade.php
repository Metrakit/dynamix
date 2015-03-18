@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.environment') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.environment') }}}</h1>
    </div>
@stop

@section('content')
    @include('theme::admin.session.session-message')

    <!-- Enable / Desable languages on the front ends -->
    @if ( count($langsFrontEnd) == 0 )
    <h2 class="text-center">{{{ Lang::get('admin.noItemToSHow') }}}</h2>
    @else

    <div class="alert alert-info" role="alert">
        {{ Lang::get('admin.languagesHelp') }}
    </div>

    <form class="form-horizontal form-lang" method="POST" action="{{ URL::to('admin/languages') }}" accept-charset="UTF-8" autocomplete="off">

        @foreach( $langsFrontEnd as $langPack)
        <div class="col-lg-4 col-md-6 col-sm-12">
            @include('theme::admin.environment.form', array('langs' => $langPack))
        </div>
        @endforeach

        <div class="clearfix"></div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> {{{ Lang::get('button.save')}}}</button>
        </div>

    </form>

    @endif

@stop
