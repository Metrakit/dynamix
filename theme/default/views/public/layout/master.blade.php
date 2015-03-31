<!DOCTYPE html>
<html>
        <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
        @section('meta_title')
    {{ Option::translate('site_name') }}
        @show
        </title>
        <meta name="author" content="{{ Config::get('app.author') }}">
        <meta name="description" content="@yield('meta_description')">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">

        <meta property="og:locale" content="fr_FR">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ Option::translate('social_title') }}">
        <meta property="og:description" content="{{ Option::translate('social_description') }}">
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:site_name" content="{{ Option::translate('site_name') }}">
        <meta property="og:image" content="{{ Option::get('cover_path') }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image:src" content="{{Request::url()}}">
        <meta name="twitter:site" content="{{ Option::get('twitter_id') }}">
        <meta name="twitter:url" content="{{ Option::get('cover_path') }}">
        <meta name="twitter:description" content="{{ Option::translate('social_description') }}">
        <meta name="twitter:title" content="{{ Option::translate('social_title') }}">

        <link rel="canonical" href="{{ Request::url() }}">

        <link rel="stylesheet" href="{{ asset('').Bassets::show('public/css/main.css') }}">
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

        <link rel="icon" href="{{asset('uploads/system/favicon/favicon.ico')}}" sizes="16x16 32x32" type="image/vnd.microsoft.icon">
        <link rel="icon" href="{{asset('uploads/system/favicon/favicon16.png')}}" sizes="16x16" type="image/png">
        <link rel="icon" href="{{asset('uploads/system/favicon/favicon32.png')}}" sizes="32x32" type="image/png">
        <link rel="icon" href="{{asset('uploads/system/favicon/favicon128.png')}}" sizes="128x128" type="image/png">
        <link rel="icon" href="{{asset('uploads/system/favicon/favicon.svg')}}" sizes="any" type="image/svg+xml">

        <link rel="icon" href="{{asset('uploads/system/favicon/apple-touch-icon.png')}}" sizes="57x57" type="image/png">
        <link rel="apple-touch-icon" href="{{asset('uploads/system/favicon/apple-touch-icon.png')}}" />
        @yield('css')
        <!--[if IE]><link rel="shortcut icon" href="{{URL::to('../favicon/favicon.ico')}}"/><![endif]-->

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        @yield('head')
        <script src="{{ asset('theme/default/public/js/vendor/head.min.js') }}"></script>
        <script>
           head.js(
              '{{ asset("theme/default/public/js/vendor/modernizr.min.js") }}',
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
                        yepnope("{{ asset('theme/default/public/js/vendor/jquery.min.js') }}");
                      }else{
                        console.log('CDN Succeed');
                      };
                    }
                  } , {
                    test: 320 < screen.width // devices 320 and up
                    , yep: [ '{{ asset("theme/default/public/js/vendor/response.min.js") }}' ]
                  } , {
                    test: window.matchMedia,
                    nope: ["{{ asset('theme/default/public/js/vendor/media.match.min.js') }}"]
                  } , {
                    test: Modernizr.input.placeholder,
                    nope: ["{{ asset('theme/default/public/js/vendor/placehold.min.js') }}"],
                    load: ["{{asset('').Bassets::show('public/js/main.js')}}"],
                    
                    @yield('load_supp_js')
                    complete: function(){                                        
                        @yield('script')
                        $(document).ready( function(){   
                            masterClass.start({{App::getLocale()}});            
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
                        <a class="navbar-brand" href="#">{{ Option::translate('site_name') }}</a>
                    </div>
                    <div class="navbar-collapse navbar-top collapse">
                        <ul class="nav navbar-nav">
                            @include('theme::public.nav.nav')
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ./ navbar-mobile -->

            <!-- header -->
            <header class="main-header">
                <figure>
                    <a href="{{URL::to('/')}}"><img src="{{asset('theme/default/public/img/logo.png')}}" alt="Logo CMS"/></a>
                </figure>
                @yield('header')
            </header>
            <!-- ./ header -->

            <!-- navbar-desktop-->
            <div class="navbar navbar-default navbar-blue hidden-xs" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-collapse navbar-top collapse">
                        <ul class="nav navbar-nav">
                            @include('theme::public.nav.nav')
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            @if(Auth::check())
                                @if(Auth::user()->hasRole('admin'))
                                    <li><a href="{{URL::to('admin')}}">Tableau de bord</a></li>
                                @endif
                                <li><a href="{{ URL::route('logout') }}">Logout</a></li>
                            @else
                                @if(Option::get('enable_registration') == true)
                                    <li><a href="{{ URL::route('registration') }}">Register</a></li>
                                @endif
                                <li><a href="{{ URL::route('public.login') }}">Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ./ navbar-desktop -->

<!--             {{var_dump(Session::all())}} -->
            <!-- container.main -->
            <div class="container main">
                <div class="row">
                @if ( !Request::is('/') && !Request::is(App::getLocale()) )
                @section('ariane')
<a href="{{URL::to('/')}}"><span class="glyphicon glyphicon-home"></span></a>&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                @show
                @endif
                </div>
                <div class="row">
                    @yield('page-header')
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
                        Designed & Developped by <a rel="noindex nofollow" href="http://www.davidlepaux.fr">David Lepaux</a>&nbsp;|
                        <a href="{{ URL::to('choose-your-language') }}"><img class="img-rounded" height="16px" width="16px" src="{{ Locale::findCached(App::getLocale())->flag }}"/></a>
                    </p>
                    @yield('footer')
                </div>
            </footer>
            <!-- ./ footer -->
        </div>
        @yield('script_bottom')
    </body>
</html>