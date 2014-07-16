<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
        @section('title')
Coiffure Homme Daniel C.
        @show
        </title>
        <meta name="author" content="{{Config::get('app.author')}}">
        <meta name="description" content="@yield('meta_description')">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">

        <link rel="canonical" href="{{Request::url()}}">

        <link rel="stylesheet" href="{{ asset('') }}{{Bassets::show('css/main.min.css')}}">
        <link rel="stylesheet" href="{{ asset('') }}{{Bassets::show('css/main.back.min.css')}}">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

        <link rel="icon" href="{{asset('favicon/favicon.ico')}}" sizes="16x16 32x32" type="image/vnd.microsoft.icon">
        <link rel="icon" href="{{asset('favicon/favicon16.png')}}" sizes="16x16" type="image/png">
        <link rel="icon" href="{{asset('favicon/favicon32.png')}}" sizes="32x32" type="image/png">
        <link rel="icon" href="{{asset('favicon/favicon128.png')}}" sizes="128x128" type="image/png">
        <link rel="icon" href="{{asset('favicon/favicon.svg')}}" sizes="any" type="image/svg+xml">

        <link rel="icon" href="{{asset('favicon/apple-touch-icon.png')}}" sizes="57x57" type="image/png">
        <link rel="apple-touch-icon" href="{{asset('favicon/apple-touch-icon.png')}}" />

        <!--[if IE]><link rel="shortcut icon" href="{{URL::to('../favicon/favicon.ico')}}"/><![endif]-->

        @yield('head')
        <script src="{{ asset('js/vendor/head.min.js') }}"></script>
        <script>
           head.js(
              '{{ asset("js/vendor/modernizr.min.js") }}',
              function() {                
                /* DOM Ready */
                yepnope([
                  {
                    load: '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
                    complete: function()
                    {
                      if ( !window.jQuery ) 
                      {
                        console.log('CDN Failed - Loading local version of jQuery.');
                        yepnope("{{ asset('/js/vendor/jquery-1.10.2.min.js') }}");
                      }else{
                        console.log('CDN Succeed');
                      };
                    }
                  } , {
                    test: 320 < screen.width // devices 320 and up
                    , yep: [ '{{ asset("js/vendor/response.min.js") }}' ]
                  } , {
                    test: window.matchMedia,
                    nope: ["{{ asset('/js/vendor/media.match.min.js') }}"]
                  } , {
                    test: Modernizr.input.placeholder,
                    nope: ["{{ asset('/js/vendor/placehold.min.js') }}"],
                    load: ["{{ asset('') }}{{ Bassets::show('js/main.min.js') }}","{{ asset('') }}{{ Bassets::show('js/main.back.min.js') }}"],
                    complete: function(){                                        
                        @yield('script')
                        $(document).ready( function(){
                            $("img").unveil();                        
                            @yield('scriptOnReady')
                        });
                    }
                  }
                ]);
            });
        </script>
    </head>
    <body id="admin">
        <div id="wrapper">

            <!--[if lt IE 8]>
            <p class="chromeframe">Vous utilizes une version <strong>obsolète</strong> de votre navigateur. S'il vous plait, veuillez <a href="http://browsehappy.com/" target="_blank">mettre à jour votre navigateur</a> ou <a href="http://www.google.com/chromeframe/?redirect=true" target="_blank">activez Google Chrome Frame</a> pour améliorer votre expérience.</p>
            <![endif]-->

            <!-- Navbar for mobile only-->
            <nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-top">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Daniel C.</a>
                    </div>
                    <div class="navbar-collapse navbar-top collapse">
                        <ul class="nav navbar-nav">
                            @include('site.static.menu-li')
                        </ul>
                        <!-- ./ nav-collapse -->
                    </div>
                </div>
            </nav>
            <!-- ./ navbar -->
            <header class="main-header">
                <div class="logo">
                    <div class="logo-content">
                    <div>
                        <a href="{{ asset('/') }}"><img src="{{ asset('img/sources/logo.png') }}" alt="Coiffure Homme Daniel C." title="Coiffure Homme Daniel C."/></a>
                    </div>
                    </div>
                    <div class="contact-mobile">
                    <div>
                        
                    </div>
                    </div>
                </div>
                <div class="scroll-me">
                    <span>Scroll Down</span>
                    <div class="top"></div>
                    <div class="middle"></div>
                    <div class="bottom"></div>
                </div>
            </header>

            <div class="container main">
                <section class="ariane">
                @section('ariane')
                    <a href="{{ asset('/') }}"><img src="{{ asset('img/sources/home.png') }}" alt="Accueil - Coiffure Homme Daniel C."></a>
                    <span class="icon-custom chevron-right"></span> 
                    <a href="{{ asset('admin') }}">Interface d'administration</a>
                @show
                </section>
                @yield('content')
            </div>


            @yield('container')


            <footer>
                <div class="container">
                    <p class="center primary">
                        <a class="linkHidden" href="{{ asset('mentions-legales')}}">Mentions légales</a>&nbsp;|
                        <a class="linkHidden" href="{{ asset('plan-du-site') }}">Plan du site</a>&nbsp;|
                        <a class="linkHidden" href="{{ asset('contact') }}">Contact</a>&nbsp;|
                        Designed & Developped by <a class="linkHidden" rel="noindex nofollow" href="http://www.davidlepaux.fr">David Lepaux</a>
                    </p>
                    @yield('footer')
                </div>
            </footer>


        </div>
        @yield('script_bottom')
    </body>
</html>
