<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <!-- navbar-header -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand favicon" href="{{URL::to('/')}}"><img class="inline-block" src="{{asset('uploads/system/favicon/favicon32.png')}}" alt="Logo"> <span>{{ Option::translate('site_name') }}</span></a>
    </div>
    <!-- /.navbar-header -->

    <!-- navbar-top -->
    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown pull-right">
            <a class="dropdown-toggle nav-user" data-toggle="dropdown" href="#">
                <img class="img-circle inlineBlock" height="34px" width="34px" src="{{$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->email ) ) ) . "?d=" . urlencode( URL::to('/img/gravatar/default.jpg') ) . "&s=34px"}}" alt="gravatar" />
                {{$user->email}}
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{ URL::to('/admin/profil' ) }}"><i class="fa fa-user fa-fw"></i> {{{ Lang::get('auth.show_profil') }}}</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ URL::route('logout') }}"><i class="fa fa-sign-out fa-fw"></i> {{{ Lang::get('auth.logout') }}}</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <!-- /.navbar-static-side -->
    <div class="navbar-default sidebar sidebar-inverse" role="navigation">
        <div class="sidebar-nav navbar-collapse collapse">
            <ul class="nav" id="side-menu">
                <li {{(Request::is( 'admin' ) ? 'class="active"' : '')}}>
                    <a href="{{ URL::to('/admin/') }}"><i class="fa fa-dashboard fa-fw"></i> {{{ Lang::get('admin.dashboard') }}}</a>
                </li>
                @if (Config::get('display.onepage') && $user->hasPermission('manage','page'))
                    <li {{(Request::is( 'admin/onepage' ) ? 'class="active"' : '')}}>
                        <a href="{{ URL::to('/admin/onepage') }}"><i class="fa fa-align-justify"></i> {{{Lang::get('admin.onepage')}}} </a>                        
                    </li>
                @endif
                {{ $user->getAuthorizedNavigations() }}
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>