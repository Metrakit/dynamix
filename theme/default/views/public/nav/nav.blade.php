<?php
	$navigations = Nav::getNavigations();
?>
@foreach( $navigations as $nav )
		@if( count( $nav->children() ) != 0 )
			<li class="dropdown">
				@if(Config::get('core::display.onepage'))
				<a href="#{{ $nav->navigable()->first()->ancor }}" class="dropdown-toggle" data-toggle="dropdown">{{ $nav->title() }} <b class="caret"></b></a>
				@else
				<a href="{{ URL::to( (Localizr::getURLLocale()) . $nav->url() ) }}" class="dropdown-toggle" data-toggle="dropdown">{{ $nav->title() }} <b class="caret"></b></a>
				@endif

				<ul class="dropdown-menu">
				@foreach( $nav->children() as $child )
					<li {{ ( Request::is( $child->url() ) ? ' class="active"' : '' ) }}><a href="{{ URL::to( $child->url() ) }}">{{ $child->title() }}</a></li>
				@endforeach
				</ul>
		@else
			@if(Config::get('core::display.onepage'))
				<li {{ ( Request::is( $nav->url() ) ? ' class="active"' : '' ) }}><a href="#{{ $nav->navigable()->first()->ancor }}">{{ $nav->title() }}</a>
			@else	
			<li {{ ( Request::is( $nav->url() ) ? ' class="active"' : '' ) }}><a href="{{ URL::to( $nav->url() ) }}">{{ $nav->title() }}</a>
			@endif
		@endif
			</li>
@endforeach