@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin/admin.menu') }}} |
@parent
@stop


@section('ariane')
@parent
&nbsp;<a href="{{URL::to('admin')}}">{{{ Lang::get('admin/admin.dashboard') }}}</a>&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/menu')}}">{{{ Lang::get('admin/admin.menu') }}}</a>
@stop


@section('content')
<div class="col-sm-12">
	<div class="alert alert-warning alert-dismissable">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    <p>
	    	Pour créer un menu simple, pointant vers une ressource (page|galerie) il vous suffit d'avoir une ressource disponible.<br>
	    	Pour créer un menu avec une arborescance (voir Tarifs..), créez tout d'abord un menu de type 'Conteneur de sous-menu' (=linkcontainer). Puis ajoutez vos menus normalement.
	    </p>
	</div>
</div>

@if( !empty($page_not_allowed) || !empty($mosaique_not_allowed) )
<h2>{{{ Lang::get('admin/admin.resource_not_allowed') }}}</h2>
<div class="col-sm-12">
	@if(count($mosaique_not_allowed) != 0)
	<div class="col-sm-6">
	<h3>Galeries</h3>
	<table class="table">
		<tr>
		    <th>Titre</th>
		    <th>URL</th>
		    <th>Description</th>
		    <th>Créé le</th>
		</tr>
		@foreach($mosaique_not_allowed as $mosaique)
		<tr>
		    <td>{{$mosaique->title}}</td>
		    <td>{{$mosaique->url}}</td>
		    <td>{{$mosaique->description}}</td>
		    <td>{{$mosaique->created_at}}</td>
		</tr>
		@endforeach
	</table>
	</div>
	@endif
	@if(count($page_not_allowed) != 0)
	<div class="col-sm-6">
	<h3>Pages</h3>
	<table class="table">
		<tr>
		    <th>Titre</th>
		    <th>URL</th>
		    <th>Meta Description</th>
		    <th>Créé le</th>
		</tr>
		@foreach($page_not_allowed as $page)
		<tr>
		    <td>{{$page->title}}</td>
		    <td>{{$page->url}}</td>
		    <td>{{$page->meta_description}}</td>
		    <td>{{$page->created_at}}</td>
		</tr>
		@endforeach
	</table>
	</div>
	@endif
</div>
@endif

<h2>{{{ Lang::get('admin/admin.menu') }}}</h2>
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

	<section class="menus">
	<?php
		$order_main = 1;
	?>
	@foreach( $menus as $menu )
		<section class="menu-objects">
		<?php
			$order_second = 1;
		?>
		@if( count( $menu->children() ) != 0 )
			@include('admin.menu.object-menu', array( 'menu' => $menu, 'role' => 'parent' ))
			<div class="clearfix"></div>
			<?php
				$order_second = 1;
			?>
			@foreach( $menu->children() as $child )
				@include('admin.menu.object-menu', array( 'menu' => $child, 'role' => 'child' ))
				<?php
					$order_second++;
				?>
			@endforeach
		@else	
			@include('admin.menu.object-menu', array( 'menu' => $menu, 'role' => 'parent' ))
		@endif
			<div class="clearfix"></div>
			<div class="menu-object create">
				{{ Form::open(array('url' => 'admin/menu/create-menu', 'method' => 'GET')) }}
					{{ Form::hidden('order', $order_second )}}
					{{ Form::hidden('parent_id', $menu->id )}}
					<button type="submit" class="btn btn-default btn-sm btn-rounded"><span class="glyphicon glyphicon-plus"></span></button>
				{{ Form::close() }}
			</div>
			<div class="clearfix"></div>
		</section>
		<?php
			$order_main++;

		?>
	@endforeach
		<section class="menu-objects create">
			{{ Form::open(array('url' => 'admin/menu/create-new-menu', 'method' => 'GET')) }}
				{{ Form::hidden('order', $order_main) }}
				<button type="submit" class="btn btn-primary btn-sm btn-rounded"><span class="glyphicon glyphicon-plus"></span></button>
			{{ Form::close() }}
		</section>
		<div class="clearfix"></div>
	</section>
</div>
<div class="clearfix"></div>

@stop