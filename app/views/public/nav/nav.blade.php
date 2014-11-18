<?php
	$navigations = Cachr::getCache('DB_Nav');
?>
@foreach( $navigations as $nav )
		@if( count( $nav->children() ) != 0 )
			<li class="dropdown">
				<a href="{{ URL::to( App::getLocale() . $nav->url() ) }}" class="dropdown-toggle" data-toggle="dropdown">{{ $nav->title() }} <b class="caret"></b></a>
				<ul class="dropdown-menu">
				@foreach( $nav->children() as $child )
					<li {{ ( Request::is( App::getLocale() . $child->url() ) ? ' class="active"' : '' ) }}><a href="{{ URL::to( App::getLocale() . $child->url() ) }}">{{ $child->title() }}</a></li>
				@endforeach
				</ul>
		@else	
			<li {{ ( Request::is( App::getLocale() . $nav->url() ) ? ' class="active"' : '' ) }}><a href="{{ URL::to( App::getLocale() . $nav->url() ) }}">{{ $nav->title() }}</a>
		@endif
			</li>
@endforeach
			<li><a href="#">Locale : {{App::getLocale()}}</a></li>