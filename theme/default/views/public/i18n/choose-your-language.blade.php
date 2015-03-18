@extends('theme::public.layout.master')

@section('meta_title')
Choose your language | @parent
@stop


@section('meta_description')
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">Choose your language</h1>
    </div>
@stop

@section('ariane')
@parent
&nbsp;<a href="{{ URL::to( 'choose-your-language' ) }}">Choose your language</a>
@stop

@section('content')
@include('theme::public.session.session-message')


<!-- Liste des langues avec le liens dynam.ix/{locale} -->
<div class="row">
@foreach(Cachr::getCache('DB_LocalesEnabled') as $locale)
	<div class="col-md-4">
		<a href="{{URL::to($locale->id)}}" style="line-height:48px">
			<img class="img-circle" height="48px" width="48px" src="{{$locale->flag}}"> {{$locale->name_locale}}
		</a>
	</div>
@endforeach
	<div class="clearfix"></div>
</div>

@stop