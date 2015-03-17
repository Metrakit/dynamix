<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
        @section('meta_title')
    {{ Cachr::getCache('DB_Option')->site_name() }}
        @show
        </title>
        <meta name="author" content="{{Config::get('app.author')}}">
        <meta name="description" content="@yield('meta_description')">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">

        <meta property="og:locale" content="fr_FR">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ Cachr::getCache('DB_Option')->i18n_social_title }}">
        <meta property="og:description" content="{{ Cachr::getCache('DB_Option')->i18n_social_description }}">
        <meta property="og:url" content="{{Request::url()}}">
        <meta property="og:site_name" content="{{ Cachr::getCache('DB_Option')->site_name() }}">
        <meta property="og:image" content="{{ Cachr::getCache('DB_Option')->cover_path }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image:src" content="{{Request::url()}}">
        <meta name="twitter:site" content="{{ Cachr::getCache('DB_Option')->twitter_id }}">
        <meta name="twitter:url" content="{{ Cachr::getCache('DB_Option')->cover_path }}">
        <meta name="twitter:description" content="{{ Cachr::getCache('DB_Option')->i18n_social_description }}">
        <meta name="twitter:title" content="{{ Cachr::getCache('DB_Option')->i18n_social_title }}">

        <link rel="canonical" href="{{Request::url()}}">

        <link rel="stylesheet" href="{{ asset('').Bassets::show('admin/css/main.css') }}">
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

        <link rel="icon" href="{{asset('favicon/favicon.ico')}}" sizes="16x16 32x32" type="image/vnd.microsoft.icon">
        <link rel="icon" href="{{asset('favicon/favicon16.png')}}" sizes="16x16" type="image/png">
        <link rel="icon" href="{{asset('favicon/favicon32.png')}}" sizes="32x32" type="image/png">
        <link rel="icon" href="{{asset('favicon/favicon128.png')}}" sizes="128x128" type="image/png">
        <link rel="icon" href="{{asset('favicon/favicon.svg')}}" sizes="any" type="image/svg+xml">

        <link rel="icon" href="{{asset('favicon/apple-touch-icon.png')}}" sizes="57x57" type="image/png">
        <link rel="apple-touch-icon" href="{{asset('favicon/apple-touch-icon.png')}}" />
        @yield('css')
        <!--[if IE]><link rel="shortcut icon" href="{{URL::to('../favicon/favicon.ico')}}"/><![endif]-->

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        @yield('head')
        <script src="{{ asset('js/vendor/head.min.js') }}"></script>
        <script>
           head.js(
              '{{ asset("js/vendor/modernizr.min.js") }}',
              function() {
                @yield('scriptYepnope')                
                /* DOM Ready */
                yepnope([
                  {
                    load: '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js',
                    complete: function()
                    {
                      if ( !window.jQuery ) 
                      {
                        console.log('CDN Failed - Loading local version of jQuery.');
                        yepnope("{{ asset('js/vendor/jquery.min.js') }}");
                      }else{
                        console.log('CDN Succeed');
                      };
                    }
                  } , {
                    test: 320 < screen.width // devices 320 and up
                    , yep: [ '{{ asset("js/vendor/response.min.js") }}' ]
                  } , {
                    test: window.matchMedia,
                    nope: ["{{ asset('js/vendor/media.match.min.js') }}"]
                  } , {
                    test: Modernizr.input.placeholder,
                    nope: ["{{ asset('js/vendor/placehold.min.js') }}"],
                    load: ["{{asset('').Bassets::show('admin/js/main.css')}}"],
                    
                    @yield('load_supp_js')
                    complete: function(){                                        
                        @yield('script')
                        $(document).ready( function(){   
                            masterClass.start();
                            masterAdminClass.start();              
                            @yield('scriptOnReady')
                        });
                    }
                  }
                ]);
            });
        </script>
    </head>
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
        @yield('modal')
        <!-- Modal -->
            <!-- Are you sure? -->
            <!-- Modal -->
            <div class="modal fade" id="modal-confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal-confirm-delete-title" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-confirm-delete-title">{{{Lang::get('admin.confirm-delete-title')}}}</h4>
                  </div>
                  <div class="modal-body">
                    {{Lang::get('admin.confirm-delete-description')}}
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger confirm">{{{Lang::get('admin.confirm-delete')}}}</button>
                    <button type="button" class="btn btn-lg btn-primary" data-dismiss="modal">{{{Lang::get('admin.cancel')}}}</button>
                  </div>
                </div>
              </div>
            </div>
        <!-- ENd Modal -->
        @yield('script_bottom')
    </body>
</html>