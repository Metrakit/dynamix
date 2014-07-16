@extends('admin.layout.master')

{{-- Web site Title --}}
@section('title')
Management des pages |
@parent
@stop

{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ URL::to('admin/page') }}">Management des pages</a></a>
@stop

{{-- Content --}}
@section('content')

    <h1>Management des pages</h1>

    <!-- Colonne gauche -->
    <div class="col-sm-9">

        @if ( Session::get('error') )
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('error') }}
        </div>
        @endif
        @if ( Session::get('notice') )
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('notice') }}
        </div>
        @endif
        @if ( Session::get('success') )
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('success') }}
        </div>
        @endif

        <section class="posts">
        <!-- Last pages  -->
        <div class="row">
        @foreach($pages as $page)
            <div class="col-sm-12">
                <h3><strong><a href="{{ URL::to('admin/page/'.$page->id) }}">{{ $page->title }}</a></strong></h3>
                <p>
                    {{ str_limit($page->content(),300) }}
                </p>
            </div>
            <div class="col-sm-12">
                <a href="{{ URL::to('admin/page/' . $page->id . '/edit') }}" class="btn btn-warning" title="Modifier l'article"><span class="glyphicon glyphicon-pencil"></span> Modifier l'article</a>
            </div>
        @endforeach
            <div class="col-sm-12 right">{{ $pages->links() }}</div>
            <div class="clearfix"></div>
        </div>
        <!-- ./ last page -->

        </section>

    </div>

    <!-- Colonne droite -->
    <div class="col-sm-3">
    </div>
    <div class="clearfix"></div>
@stop