@extends('admin.layout.master')


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
    @include('includes.session-message')

    <!-- Enable / Desable languages on the front ends -->


        <form class="form-horizontal" method="POST" action="{{ URL::to('admin/environment') }}" accept-charset="UTF-8" autocomplete="off">

            @foreach( $langsFrontEnd as $langPack)
            <div class="col-lg-4 col-sm-6">
                @include('admin.environment.form', array('langs' => $langPack))
            </div>
            @endforeach

            <div class="clearfix"></div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-ok"></span> {{{ Lang::get('button.save')}}}</button>
            </div>

        </form>

@stop