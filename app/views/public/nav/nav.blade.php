<?php
	$navigations = Nav::where('parent_id','=',0)->orderBy('order','ASC')->get();
?>
@foreach( $navigations as $nav )
		@if( count( $nav->children() ) != 0 )
			<li class="dropdown" id="{{$nav->id}}">
				<a href="{{ URL::to( $nav->url() ) }}" class="dropdown-toggle" data-toggle="dropdown">{{ $nav->title() }} <b class="caret"></b></a>
				<ul class="dropdown-menu">
				@foreach( $nav->children() as $child )
					<li {{ ( Request::is( $child->url() ) ? ' class="active"' : '' ) }}><a href="{{ URL::to( $child->url() ) }}">{{ $child->title() }}</a></li>
				@endforeach
				</ul>
		@else	
			<li {{ ( Request::is( $nav->url() ) ? ' class="active"' : '' ) }}><a href="{{ URL::to( $nav->url() ) }}">{{ $nav->title() }}</a>
		@endif
			</li>
@endforeach