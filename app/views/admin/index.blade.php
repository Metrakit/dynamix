@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.dashboard') }}} |
@parent
@stop


@section('content')
    @include('includes.session-message')

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> {{{ Lang::get('admin.sessions') }}}
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="ga-sessionsPerDay"></div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <div class="col-lg-8">    
        <!-- Session count -->
        <!-- User count -->
        <!-- Pages seen count -->
        <!-- Pages/session count -->
        <!-- Time session count -->
        <!-- Rebound -->
        <!-- % new session -->
    </div>
    <div class="col-lg-4">
        <!-- New visitor / Returning visitor -->
    </div>
    <div class="col-lg-8">
    </div>
    <div class="clearfix"></div>
@stop

@section('scriptOnReady')
/*ga-sessionsPerDay*/
Morris.Area({
    element: 'ga-sessionsPerDay',
    data: {{ $ga_sessionsPerDay }},
    xkey: 'date',
    ykeys: ['sessions'],
    labels: ['Sessions'],
    hideHover: 'auto',
    resize: true
  });
@stop