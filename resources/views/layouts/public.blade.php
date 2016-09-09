<!DOCTYPE html>
<html lang="fr">
<head>
    <title>@yield('title', 'Salle de sport , de musculation, de fitness, Myosine, sur Angers')</title>

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{URL::to('/')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/bower_components/bootstrap-material-design/dist/css/bootstrap-material-design.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/bower_components/bootstrap-material-design/dist/css/ripples.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/css/main.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/css/header.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/css/navbar.css">

    @if(Session::has('bandeauContent'))
        <link rel="stylesheet" href="{{URL::to('/')}}/css/li-scroller.css">
    @endif

    @yield('style')

    <!-- Autres -->
    <meta charset="UTF-8">
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <meta name="language" content="fr">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="keywords" content="sport, fitness, musculation, angers, perte, de, poid, developpement, masse, musculaire, sauna">
    <meta name="author" content="Ugho STEPHAN">
    <meta name="publisher" content="Ugho STEPHAN">
    <meta name="copyright" content="Ugho STEPHAN">
    <meta name="description" content="@yield('description', 'Salle de sport sur Angers - Musculation, fitness, sauna, ...')" />
    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.png" type="image/icon">
</head>
<body>
    @include('layouts.partials.header', [])

    <div class="container">

        @if(Session::has('bandeauContent'))
            <br>
            <div id="bandeau_title">
                NEWS
            </div>
            <ul id="bandeau" class="newsticker">
                @foreach (Session::get('bandeauContent') as $bandeauContent )
                    <li><span class="bandeauContent">{{ $bandeauContent->libelle_sb }}</span></li>
                @endforeach
            </ul>
        @endif

        @if ($__env->yieldContent('section_title'))
            <div class="section_title">
                <h1>@yield('section_title')</h1>
                <hr>
            </div>
        @endif

        @yield('admin_menu')

        @if ( Session::has('flash_message') )
            <div class="delete alert alert-dismissible alert-{{ Session::get('flash_type') }}">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        @yield('content')
    </div>

    @include('layouts.partials.footer', [])

    <script src="{{URL::to('/')}}/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{{URL::to('/')}}/js/jquery.li-scroller.1.0.js"></script>
    <script src="{{URL::to('/')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{URL::to('/')}}/bower_components/bootstrap-material-design/dist/js/material.min.js"></script>
    <script src="{{URL::to('/')}}/bower_components/bootstrap-material-design/dist/js/ripples.min.js"></script>
    <script src="{{URL::to('/')}}/js/main.js"></script>
    <script src="{{URL::to('/')}}/js/navbar.js"></script>
    @yield('script')

    @if(Session::has('bandeauContent'))
        <script>
            $(document).ready(function() {
                $("#bandeau").liScroll();
            });
        </script>
    @endif
</body>
</html>