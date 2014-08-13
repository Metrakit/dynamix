<div class="col-sm-2 content nav-inverse">
    <ul class="nav nav-pills nav-stacked">
		<li {{(Request::is( '/' ) ? 'class="active"' : '')}}><a href="{{URL::to('/')}}"><img src="{{asset('favicon/favicon32-white.png')}}" alt="Logo"> {{ App::make('CacheController')->getCache('DB_Option')->site_name }}</a></li>
		<li {{(Request::is( 'admin' ) ? 'class="active"' : '')}}><a href="{{URL::to('admin')}}"><span class="glyphicon glyphicon-home"></span> Tableau de bord</a></li>
		<li {{(Request::is( 'admin/media' ) ? 'class="active"' : '')}}><a href="{{URL::to('admin/media')}}"><span class="glyphicon glyphicon-cloud"></span> Mes Images</a></li>
		<li {{(Request::is( 'admin/mosaique' ) ? 'class="active"' : '')}}><a href="{{URL::to('admin/mosaique')}}"><span class="glyphicon glyphicon-picture"></span> Mosaïques</a></li>
		<li {{(Request::is( 'admin/gallery' ) ? 'class="active"' : '')}}><a href="{{URL::to('admin/gallery')}}"><span class="glyphicon glyphicon-picture"></span> Galeries</a></li>
		<li {{(Request::is( 'admin/page' ) ? 'class="active"' : '')}}><a href="{{URL::to('admin/page')}}"><span class="glyphicon glyphicon-book"></span> Pages</a></li>
		<li {{(Request::is( 'admin/menu' ) ? 'class="active"' : '')}}><a href="{{URL::to('admin/menu')}}"><span class="glyphicon glyphicon-list"></span> Menus</a></li>
		<li {{(Request::is( 'admin/user' ) ? 'class="active"' : '')}}><a href="{{URL::to('admin/user')}}"><span class="glyphicon glyphicon-user"></span> Utilisateurs</a></li>
		<li {{(Request::is( 'admin/option' ) ? 'class="active"' : '')}}><a href="{{URL::to('admin/option')}}"><span class="glyphicon glyphicon-cog"></span> Général</a></li>
    </ul>
</div>