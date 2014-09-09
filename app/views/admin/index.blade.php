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
            <?php

            $site_id = Analytics::getSiteIdByUrl('http://metra-concept.fr'); // return something like 'ga:11111111'

            $stats = Analytics::query($site_id, '7daysAgo', 'yesterday', 'ga:visits,ga:pageviews');

            echo var_dump($stats);
            ?>
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
@stop