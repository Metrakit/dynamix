<!DOCTYPE html>
<html>
    @include('includes.head', $data = array( 'load_css' => array( asset(Bassets::show('css/main.min.css')) ), 'load_js' => asset(Bassets::show('js/main.min.js')) ))
    <body>

        <div id="wrapper">
            
            <!--[if lt IE 8]>
            <p class="chromeframe">Vous utilizes une version <strong>obsolète</strong> de votre navigateur. S'il vous plait, veuillez <a href="http://browsehappy.com/" target="_blank">mettre à jour votre navigateur</a> ou <a href="http://www.google.com/chromeframe/?redirect=true" target="_blank">activez Google Chrome Frame</a> pour améliorer votre expérience.</p>
            <![endif]-->

            <!-- navbar-mobile-->
            <div class="navbar navbar-default navbar-inverse navbar-fixed-top visible-xs" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-top">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">{{App::make('CacheController')->getCache('DB_Option')->site_name()}}</a>
                    </div>
                    <div class="navbar-collapse navbar-top collapse">
                        <ul class="nav navbar-nav">
                            @include('public.nav.nav')
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ./ navbar-mobile -->

            <!-- header -->
            <header class="main-header">
                <figure>
                    <a href="{{URL::to('/')}}"><img src="{{asset('img/sources/logo.png')}}" alt="Logo CMS"/></a>
                </figure>
                @yield('header')
            </header>
            <!-- ./ header -->

            <!-- navbar-desktop-->
            <div class="navbar navbar-default navbar-inverse hidden-xs" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-collapse navbar-top collapse">
                        <ul class="nav navbar-nav">
                            @include('public.nav.nav')
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ./ navbar-desktop -->

            <!-- container.main -->
            <div class="container main">
                <div class="row">
                @if (!Request::is('/') )
                @section('ariane')
<a href="{{URL::to('/')}}"><span class="glyphicon glyphicon-home"></span></a>&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                @show
                @endif
                </div>
                <div class="row">
                    @yield('content')
                </div>

            </div>
            <!-- ./ container.main -->
            @yield('container')

            <!-- footer -->
            <footer>
                <div class="container">
                    <p class="center primary">
                        Mentions légales&nbsp;|
                        Plan du site&nbsp;|
                        Contact&nbsp;|
                        Designed & Developped by <a rel="noindex nofollow" href="http://www.davidlepaux.fr">David Lepaux</a>
                    </p>
                    @yield('footer')
                </div>
            </footer>
            <!-- ./ footer -->
        </div>
        @yield('script_bottom')
    </body>
</html>