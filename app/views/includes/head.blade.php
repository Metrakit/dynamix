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

    <link rel="canonical" href="{{Request::url()}}">

    @foreach( $load_css as $css )
    <link rel="stylesheet" href="{{ $css }}">
    @endforeach
    
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
            /* DOM Ready */
            yepnope([
              {
                load: '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
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
                load: ["{{ $load_js }}"],
                complete: function(){                                        
                    @yield('script')
                    $(document).ready( function(){   
                        masterClass.start();
                        {{ (isset($scriptOnReady)?$scriptOnReady:'')}}                
                        @yield('scriptOnReady')
                    });
                }
              }
            ]);
        });
    </script>
</head>