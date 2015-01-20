<!DOCTYPE html>
<html>
    @include('includes.head', $data = array( 'load_css' => array( asset(Bassets::show('css/main.min.css')) ), 'load_js' => asset(Bassets::show('js/main.min.js')) ))
    <body id="onepage">

        <div id="wrapper">
        
            <!--[if lt IE 8]>
            <p class="chromeframe">Vous utilizes une version <strong>obsolète</strong> de votre navigateur. S'il vous plait, veuillez <a href="http://browsehappy.com/" target="_blank">mettre à jour votre navigateur</a></p>
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
                        <a class="navbar-brand" href="#">{{Cachr::getCache('DB_Option')->site_name()}}</a>
                    </div>
                    <div class="navbar-collapse navbar-top collapse">
                        <ul class="nav navbar-nav">
                            @include('public.nav.nav')
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ./ navbar-mobile -->

            <!-- navbar-desktop-->
            <div class="navbar navbar-default navbar-inverse hidden-xs" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-collapse navbar-top collapse">
                        <ul class="nav navbar-nav">
                            @include('public.nav.nav')
                        </ul>
                        @if(Auth::check())
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{URL::to('admin')}}">Tableau de bord</a></li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
            <!-- ./ navbar-desktop -->

            <!-- container.main -->
            @yield('container')
            <!-- ./ container.main -->
        </div>
        @yield('script_bottom')
    </body>
</html>