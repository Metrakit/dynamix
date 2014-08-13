<!DOCTYPE html>
<html>
    @include('includes.head', $data = array( 'load_css' => array( asset(Bassets::show('css/main.min.css')), asset(Bassets::show('css/main.back.min.css')) ), 'load_js' => asset(Bassets::show('js/main.min.js')).'","'.asset(Bassets::show('js/main.back.min.js')).'","'.asset('src/js/vendor/tinymce/tinymce.min.js') ))

    <body id="admin" class="@yield('classBody')">
        @yield('beforeWrapper')
        <div id="wrapper">

            <!--[if lt IE 8]>
            <p class="chromeframe">Vous utilizes une version <strong>obsolète</strong> de votre navigateur. S'il vous plait, veuillez <a href="http://browsehappy.com/" target="_blank">mettre à jour votre navigateur</a> ou <a href="http://www.google.com/chromeframe/?redirect=true" target="_blank">activez Google Chrome Frame</a> pour améliorer votre expérience.</p>
            <![endif]-->


            <!-- navbar left -->
            @include('admin.includes.menu-left-link')
            <!-- ./ navbar left -->

            <!-- content -->
            <div class="col-sm-10 main-content">
                
                @include('admin.includes.nav')

                @yield('filemanager')

                <!-- main-container -->
                <div class="admin-container">
                    <p>
                    @section('ariane')
                        @if(!isset($noAriane))
    <a href="{{URL::to('/')}}"><span class="glyphicon glyphicon-home"></span></a>&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                        @endif
                    @show
                    </p>
                    @yield('content')
                </div>
                <!-- ./ main-container -->
            </div>
            <div class="clearfix"></div>
            @yield('container')
            <!-- ./ content -->

        </div>
        @yield('script_bottom')
    </body>
</html>
