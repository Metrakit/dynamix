@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin/admin.gallery') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<a href="{{URL::to('admin')}}">{{{ Lang::get('admin/admin.dashboard') }}}</a>&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/gallery')}}">{{{ Lang::get('admin/admin.gallery') }}}</a>
@stop


@section('content')

<h2>{{{ Lang::get('admin/admin.gallery') }}}</h2>
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
@foreach($mosaiques as $mosaique)
<h3>{{$mosaique->title}}</h3>
<div class="col-sm-9">
@foreach($mosaique->galleries as $gallery)
<div class="col-sm-6 gallery-image">
	<div class="buttons">
		<div class="pull-left"><a href="{{URL::to('admin/gallery/' . $gallery->id . '/edit')}}" class="btn btn-primary btn-xs pencil"><span class="glyphicon glyphicon-pencil"></span></a></div>
		{{ Form::open(array('url' => 'admin/gallery/' . $gallery->id, 'class' => 'pull-left')) }}
			{{ Form::hidden('_method', 'DELETE') }}
			<button type="submit" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-remove"></span></button>
		{{ Form::close() }}
		<div class="clearfix"></div>
	</div>

	<div class="row">
	    <div class="col-sm-4 col-md-5 col-lg-3">
		    <a href="{{URL::to('admin/gallery/' . $gallery->id )}}"><img src="{{ $gallery->cover() }}" alt="{{$gallery->title}}" width="100%"/></a>
		</div>
	    <div class="col-lg-8 col-md-7 col-lg-9">
			<div class="row">
		    	<h4>{{$gallery->title}}</h4>
		    	<p class="help-block">{{$gallery->description}}</p>
		   	</div>
	    </div>
	</div>
</div>
@endforeach
<div class="col-sm-12 gallery-image text-center" style="margin-top:20px">
	<a href="{{URL::to('admin/gallery/create')}}" class="btn btn-lg btn-primary btn-rounded"><span class="glyphicon glyphicon-plus"></span></a>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
@endforeach
<div class="alert alert-info alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>
    	Ci-dessus, la liste de toutes vos galeries. Vous pouvez les modifier en cliquand sur <span class="glyphicon glyphicon-pencil"></span> et les supprimer en cliquant sur <span class="glyphicon glyphicon-remove"></span>.<br>
    	Pour en ajouter cliquez sur <span class="glyphicon glyphicon-plus"></span>.<br><br>
    	Pour ajouter des images dans vos galeries, cliquez sur la miniature.
    </p>
</div>


@stop
