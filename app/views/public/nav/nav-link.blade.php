@if( isset($navigations) )
@foreach( $navigations as $nav )
		@if( count( $nav->children() ) != 0 )
			<li class="dropdown">
				<a href="{{ URL::to($nav->url()) }}" class="dropdown-toggle" data-toggle="dropdown">{{ $nav->i18n_title() }} <b class="caret"></b></a>
				<ul class="dropdown-menu">
				@foreach( $nav->children() as $child )
					<li {{ ( Request::is( $child->url() ) ? ' class="active"' : '' ) }}><a href="{{ URL::to($child->url()) }}">{{ $child->i18n_title() }}</a></li>
				@endforeach
				</ul>
			</li>
		@else	
			<li {{ ( Request::is( $nav->url() ) ? ' class="active"' : '' ) }}><a href="{{ URL::to($nav->url()) }}">{{ $nav->i18n_title() }}</a>
		@endif
	</li>
@endforeach
@endif