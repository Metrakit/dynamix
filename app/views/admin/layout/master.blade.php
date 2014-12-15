<!DOCTYPE html>
<html>
    @include('includes.head', $data = array( 'load_css' => array( asset(Bassets::show('css/main.min.css')), asset(Bassets::show('css/main.back.min.css')) ), 'load_js' => asset(Bassets::show('js/main.min.js')).'","'.asset(Bassets::show('js/main.back.min.js')), 'scriptOnReady' => 'masterAdminClass.start()' ))

    <body id="admin" class="@yield('classBody')">
        @yield('beforeWrapper')

        <div id="wrapper" class="st-effect-11">
            <div class="btn-nav-left text-center">
                <span class="fa fa-bars"></span>
            </div>
            <!--[if lt IE 8]>
            <p class="chromeframe">Vous utilizes une version <strong>obsolète</strong> de votre navigateur. S'il vous plait, veuillez <a href="http://browsehappy.com/" target="_blank">mettre à jour votre navigateur</a> ou <a href="http://www.google.com/chromeframe/?redirect=true" target="_blank">activez Google Chrome Frame</a> pour améliorer votre expérience.</p>
            <![endif]-->

            <!-- navbar -->
            @include('admin.interface.nav-admin')
            <!-- ./ navbar -->

            <div id="page-wrapper">
                <div class="page-wrapper-inner">

                    <div id="section-filemanager">
                        @yield('filemanager')
                    </div>

                    <div class="page-content">

                        <div id="section-page-header">
                            @yield('page-header')
                        </div>

                        <!-- /.row -->
                        @section('ariane')
                        @if(!isset($noAriane))
                        <div class="row">
                            <p>
                <a href="{{URL::to('/')}}"><span class="glyphicon glyphicon-home"></span></a>&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                            </p>
                        </div>
                        @endif
                        @show

                        <!-- main-container -->
                        <div id="section-content">
                            @yield('content')
                        </div>
                        <!-- ./ main-container -->

                    </div>
                    @yield('container')
                </div>

                <div class="loader" style="display:none">
                    <div><span class="loader-inner"></span></div>
                </div>
            </div>
            
            <!-- ./ content -->

        </div>
        @yield('script_bottom')
    </body>
</html>