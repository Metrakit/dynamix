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
        <h1 class="page-header">{{{ Lang::get('admin.navigations') }}}
         <a href="{{URL::to('admin/navigation/create-choose')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> {{{ Lang::get('button.new') }}}</a></h1>
    </div>
@stop

@section('content')
@include('includes.session-message')



<div class="alert alert-info alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>
    	{{ Lang::get('admin.navigation_help') }}
    </p>
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
			@include('admin.navigation.presenter_manager', array( 'nav' => $nav, 'role' => 'parent' ))
			<div class="clearfix"></div>
			<?php
				$order_second = 1;
			?>
			@foreach( $nav->children() as $child )
				@include('admin.navigation.presenter_manager', array( 'nav' => $child, 'role' => 'child' ))
				<?php
					$order_second++;
				?>
			@endforeach
		@else	
			@include('admin.navigation.presenter_manager', array( 'nav' => $nav, 'role' => 'parent' ))
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

@if( count($resource_not_allowed) > 0 )
	@include('admin.navigation.presenter_resourcenotallowed_tile', array('resource_not_allowed' => $resource_not_allowed))
@endif

@stop