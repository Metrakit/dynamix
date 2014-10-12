@extends('admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.navigations') }}} |
@parent
@stop

@section('scriptOnReady')
masterAdminClass.watchMenuObjects();
@stop

@section('page-header')
    <div class="row">
        <h1 class="page-header">{{{ Lang::get('admin.navigations') }}}</h1>
    </div>
@stop

@section('content')

@include('includes.session-message')

<div class="col-sm-12">
	<div class="alert alert-info alert-dismissable">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    <p>
	    	Pour créer un menu simple, pointant vers une ressource (page|galerie) il vous suffit d'avoir une ressource disponible.<br>
	    	Pour créer un menu avec une arborescance (voir Tarifs..), créez tout d'abord un menu de type 'Conteneur de sous-menu' (=linkcontainer). Puis ajoutez vos menus normalement.
	    </p>
	</div>
</div>


<!-- Colonne gauche -->
<div class="col-sm-12">

	<section class="menus scrollHorizontalBox">
	<div id="navigation">
	<?php
		$order_main = 1;
	?>
	@foreach( $navs as $nav )
		<section class="menu-objects">
		<?php
			$order_second = 1;
		?>
		@if( count( $nav->children() ) != 0 )
			@include('admin.navigation.object-menu', array( 'nav' => $nav, 'role' => 'parent' ))
			<div class="clearfix"></div>
			<?php
				$order_second = 1;
			?>
			@foreach( $nav->children() as $child )
				@include('admin.navigation.object-menu', array( 'nav' => $child, 'role' => 'child' ))
				<?php
					$order_second++;
				?>
			@endforeach
		@else	
			@include('admin.navigation.object-menu', array( 'nav' => $nav, 'role' => 'parent' ))
		@endif
			<div class="clearfix"></div>
			<!-- <div class="create">
				{{ Form::open(array('url' => 'admin/navigation/create-menu', 'method' => 'GET')) }}
					{{ Form::hidden('order', $order_second )}}
					{{ Form::hidden('parent_id', $nav->id )}}
					<button type="submit" class="btn btn-default btn-sm btn-rounded"><span class="glyphicon glyphicon-plus"></span></button>
				{{ Form::close() }}
			</div>
			<div class="clearfix"></div> -->
		</section>
		<?php
			$order_main++;

		?>
	@endforeach
		<!-- <section class="create">
			{{ Form::open(array('url' => 'admin/navigation/create-new-menu', 'method' => 'GET')) }}
				{{ Form::hidden('order', $order_main) }}
				<button type="submit" class="btn btn-primary btn-sm btn-rounded"><span class="glyphicon glyphicon-plus"></span></button>
			{{ Form::close() }}
		</section> -->
		<div class="clearfix"></div>
	</div>
	</section>

</div>
<div class="clearfix"></div>

@if( !empty($resource_not_allowed) )
<h2>{{{ Lang::get('admin.resource_not_allowed') }}}</h2>
<div class="col-sm-12">
	<?php $h3 = ''; ?>
	@foreach($resource_not_allowed as $resource)
	<div class="col-md-4">
	<h3>{{{ Lang::get('admin.rsc'.$h3 = ( $resource->getClassName() != $h3 ? $resource->getClassName() : $h3 )) }}}</h3>
	 	@include('admin.page.presenter', array('page'=>$resource))
	</div>
	@endforeach
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
@endif

@stop