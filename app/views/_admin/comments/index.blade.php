@extends('admin.layout.master')

{{-- Web site Title --}}
@section('title')
Management des avis |
@parent
@stop

{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ URL::to('admin/comment') }}">Management des avis</a></a>
@stop

{{-- Content --}}
@section('content')

    <h1>Management des avis</h1>

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

    <div class="col-sm-6">
        <h2>Avis à modérer</h2>
        <section class="comments_to_confirm">
        <!-- Last Posts  -->
        @if(count($comments_to_confirm ) == 0)
            <div class="alert alert-success">Félicitation ! Tous les avis ont été modérés !</div>
        @else
        @foreach($comments_to_confirm as $comment)
            @include('admin.comments.one_comment',array('comment'=>$comment))            
        @endforeach
        @endif
        <p>{{ $comments_to_confirm->links() }}</p>
        <!-- ./ last post -->
        </section>
    </div>

    <div class="col-sm-6">
        <h2>Avis en ligne</h2>
        <section class="comments">
        <!-- Last Posts  -->
        @foreach($comments as $comment)
            @include('admin.comments.one_comment',array('comment'=>$comment))            
        @endforeach
        <p>{{ $comments->links() }}</p>
        <!-- ./ last post -->
        </section>
    </div>

    <div class="clearfix"></div>
@stop