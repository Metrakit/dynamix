@extends('theme::admin.layout.master')


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

	@include('theme::admin.session.session-message')

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
					@include('theme::admin.navigation.presenter_manager', array( 'nav' => $nav, 'role' => 'parent' ))
					<div class="clearfix"></div>
					<?php
					$order_second = 1;
					?>
					@foreach( $nav->children() as $child )
					@include('theme::admin.navigation.presenter_manager', array( 'nav' => $child, 'role' => 'child' ))
					<?php
					$order_second++;
					?>
					@endforeach
					@else	
					@include('theme::admin.navigation.presenter_manager', array( 'nav' => $nav, 'role' => 'parent' ))
					@endif
					<div class="clearfix"></div>
					<div class="text-center menu-object-child">
						<a href="{{ URL::to('admin/navigation/create?link_internal=1&parent_id='.$nav->id.'&order='.$order_second)}}" class="btn btn-primary" title="{{ Lang::get('admin.link_internal') }}">
							<span class="glyphicon glyphicon-plus"></span>
						</a>
					</div>
				</section>
				<?php
				$order_main++;
				?>
				@endforeach
				<section class="menu-objects">
					<a href="{{ URL::to('admin/navigation/create?link_internal=1&order='.$order_main)}}" class="btn btn-primary margin-top-lg" title="{{ Lang::get('admin.link_internal') }}">
						<span class="glyphicon glyphicon-plus"></span>
					</a>
				</section>
				<div class="clearfix"></div>
			</div>
		</section>

	</div>
	<div class="clearfix"></div>

	@if( count($resource_not_allowed) > 0 )
	@include('theme::admin.resource.presenter_not_allowed_tile', array('resource_not_allowed' => $resource_not_allowed))
	@else
	@include('theme::admin.resource.presenter_call_to_create')
	@endif

	@stop