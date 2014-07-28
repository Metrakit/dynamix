<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
@section('meta_title')
{{App::make('CacheController')->getCache('DB_Option')->site_name()}}
@show
        </title>
        <meta name="author" content="{{Config::get('app.author')}}">
        <meta name="description" content="@yield('meta_description')">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">

        <link rel="canonical" href="{{Request::url()}}">

        <link rel="stylesheet" href="{{ asset('') }}{{ Bassets::show('css/main.min.css')}}">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>

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
                    load: ["{{ asset('') }}{{ Bassets::show('js/main.min.js') }}"],
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
                        <a class="navbar-brand" href="#">Daniel C.</a>
                    </div>
                    <div class="navbar-collapse navbar-top collapse">
                        <ul class="nav navbar-nav">
                            
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

            <!-- container.main -->
            <div class="container main">
                Locale : {{App::getLocale()}}<br>

                <p class="row">
                @section('ariane')
                    @if(!isset($isIndex))
<a href="{{URL::to('/')}}"><span class="glyphicon glyphicon-home"></span></a>&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                    @endif
                @show
                </p>
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