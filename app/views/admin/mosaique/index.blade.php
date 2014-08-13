@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin/admin.mosaiques') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<a href="{{URL::to('admin')}}">{{{ Lang::get('admin/admin.dashboard') }}}</a>&nbsp;
<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/mosaiques')}}">{{{ Lang::get('admin/admin.mosaiques') }}}</a>
@stop


@section('content')
<h2>{{{ Lang::get('admin/admin.mosaiques') }}}</h2>

<!-- Colonne gauche -->
<div class="col-sm-12">

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

	<table class="table">
		<tr>
		    <th>Titre</th>
		    <th>URL</th>
		    <th>Description</th>
		    <th>Créé le</th>
		    <th>Action</th>
		</tr>
		@foreach($mosaiques as $mosaique)
		<tr>
		    <td>{{$mosaique->title}}</td>
		    <td>{{$mosaique->url}}</td>
		    <td>{{$mosaique->description}}</td>
		    <td>{{$mosaique->created_at}}</td>
		    <td>
                <a href="{{ URL::to('admin/mosaique/' . $mosaique->id . '/edit') }}" class="btn btn-primary" title="Modifier la mosaique">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
		    </td>
		</tr>
		@endforeach
	</table>


	<div class="alert alert-info alert-dismissable">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    <p>
	    	Une mosaïque va contenir une ou plusieurs galerie.<br>
	    	Vous pouvez uniquement les modifier (url, titre,...).
	    </p>
	</div>

</div>
@stop