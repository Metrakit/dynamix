@if( isset($menu) )
@foreach( $menu as $m )
		@if( count( $m->children() ) != 0 )
			<li class="dropdown">
				<a href="{{ URL::to($m->url()) }}" class="dropdown-toggle" data-toggle="dropdown">{{ $m->i18n_title() }} <b class="caret"></b></a>
				<ul class="dropdown-menu">
				@foreach( $m->children() as $child )
					<li {{ ( Request::is( $child->url() ) ? ' class="active"' : '' ) }}><a href="{{ URL::to($child->url()) }}">{{ $child->i18n_title() }}</a></li>
				@endforeach
				</ul>
			</li>
		@else	
			<li {{ ( Request::is( $m->url() ) ? ' class="active"' : '' ) }}><a href="{{ URL::to($m->url()) }}">{{ $m->i18n_title() }}</a>
		@endif
	</li>
@endforeach
@endif