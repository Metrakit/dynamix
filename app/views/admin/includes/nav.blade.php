<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <!-- navbar-header -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{URL::to('/')}}"><img src="{{asset('favicon/favicon32.png')}}" alt="Logo"> {{ App::make('CacheController')->getCache('DB_Option')->site_name }}</a>
    </div>
    <!-- /.navbar-header -->

    <!-- navbar-top -->
    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{ URL::to('/user/' . $user->id) }}"><i class="fa fa-user fa-fw"></i> {{{ Lang::get('user.profile') }}}</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ URL::to('/user/logout') }}"><i class="fa fa-sign-out fa-fw"></i> {{{ Lang::get('user.logout') }}}</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <!-- /.navbar-static-side -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse collapse">
            <ul class="nav" id="side-menu">
                <li {{(Request::is( 'admin' ) ? 'class="active"' : '')}}>
                    <a href="{{ URL::to('/admin/') }}"><i class="fa fa-dashboard fa-fw"></i> {{{ Lang::get('admin.dashboard') }}}</a>
                </li>
                {{ $user->getAuthorizedNavigations() }}
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>