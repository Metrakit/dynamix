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

@section('scriptOnReady')

    $('body').on('change', 'input[name*=is_publish_]', function (e) {
        var inputIsEnable = $(this).parent().parent().find('.input-is_enable');
        if ($(this).prop('checked')) {
            inputIsEnable.prop('checked',true);
        }
    });
    $('body').on('change', 'input.input-is_enable', function (e) {
        var inputIsPublish = $(this).parent().parent().find('input[name*=is_publish_]');
        console.log(inputIsPublish);
        if (!$(this).prop('checked')) {
            inputIsPublish.prop('checked',false);
        }
    });
@stop
