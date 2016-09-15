<!DOCTYPE html>
<html lang="fr">
<head>
    <title>@yield('title', 'Salle de sport , de musculation, de fitness, Myosine, sur Angers')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ URL::to('/') . elixir('css/vendor.css') }}">
    @yield('style')
    <link rel="stylesheet" href="{{ URL::to('/') . elixir('css/all.css') }}">

    <!-- Autres -->
    <meta charset="UTF-8">
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <meta name="language" content="fr">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="keywords" content="sport, fitness, musculation, angers, perte, de, poid, developpement, masse, musculaire, sauna">
    <meta name="author" content="Ugho STEPHAN">
    <meta name="publisher" content="Ugho STEPHAN">
    <meta name="copyright" content="Ugho STEPHAN">
    <meta name="theme-color" content="#689F38">
    <meta name="description" content="@yield('description', 'Salle de sport sur Angers - Musculation, fitness, sauna, ...')" />

    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico" type="image/x-icon">
    <link rel="icon" href="{{URL::to('/')}}/favicon.ico" type="image/x-icon">
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

    <script src="{{ URL::to('/') . elixir('js/vendor.js') }}"></script>
    @yield('script')
    <script src="{{ URL::to('/') . elixir('js/all.js') }}"></script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-48402317-3', 'auto');
        ga('send', 'pageview');
    </script>

    @if(Session::has('bandeauContent'))
        <script>
            $(document).ready(function() {
                $("#bandeau").liScroll();
            });
        </script>
    @endif
</body>
</html>