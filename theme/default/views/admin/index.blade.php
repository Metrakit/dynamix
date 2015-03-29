@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.dashboard') }}} |
@parent
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.dashboard') }}}</h1>
    </div>
@stop

@section('content')
    @include('theme::admin.session.session-message')
    @if($ga_googleAnalyticsFound)
    <div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> {{{ Lang::get('admin.sessions') }}}
            </div>
            <div class="panel-body">
                <div id="ga-sessionsPerDay"></div>
            </div>
        </div>
    </div>
    @endif

   
    @if($ga_googleAnalyticsFound)
    <div class="col-lg-8">
        <div class="row">
            <div class="col-md-4 col-xs-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <div>{{{ Lang::get('admin.sessionsCount') }}}</div>
                                <div class="huge">{{ $ga_sessionsCount }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <div>{{{ Lang::get('admin.userCount') }}}</div>
                                <div class="huge">{{ $ga_userCount }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <div>{{{ Lang::get('admin.pageSeenCount') }}}</div>
                                <div class="huge">{{ $ga_pageSeenCount }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <div>{{{ Lang::get('admin.pagesBySession') }}}</div>
                                <div class="huge">{{ $ga_pagesBySession }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <div>{{{ Lang::get('admin.timeBySession') }}}</div>
                                <div class="huge">{{ $ga_timeBySession }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <div>{{{ Lang::get('admin.rebound') }}}</div>
                                <div class="huge">{{ $ga_rebound }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> {{{ Lang::get('admin.newOnReturningVisitor') }}}
            </div>
            <div class="panel-body">
                <div id="ga-newOnReturningVisitor"></div>   
            </div>
        </div>
    </div>
    </div>
    @endif
    <div class="col-lg-4 pull-right">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> {{{ Lang::get('admin.usefull_link') }}}
            </div>
            <div class="panel-body">
                <a href="https://compressor.io/">
                <img class="img-responsive" src="{{asset('theme/default/admin/img/compressor-io-logo.png')}}" alt="compressor logo">
                </a>
            </div>
        </div>
    </div>
   
    <div class="clearfix"></div>
    
@stop
@if($ga_googleAnalyticsFound)
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
/*ga-newOnReturningVisitor*/
Morris.Donut({
    element: 'ga-newOnReturningVisitor',
    data: {{ $ga_newOnReturningVisitor }} ,
    formatter: function (y) { return y + "%" },
    hideHover: 'auto',
    resize: true
  });
@stop
@endif