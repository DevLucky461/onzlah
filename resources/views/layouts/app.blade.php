<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' >
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@700&display=swap" rel="stylesheet">

    <!-- Facebook Share Button -->
    <meta property="og:url" content="https://www.google.com/">
	<meta property="og:type" content="article">
	<meta property="og:title" content="Onzlah">
	<meta property="og:description" content="Onzlah">
	<meta property="og:image" content="https://www.google.com">

    @yield('prescript')
</head>
<body>
    <div id="app">
            @yield('content')
    </div>
    @include('sweetalert::alert')

    <div class="footer-pos">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-3">
                    <a href="/main">
                        <div class="nav_btn nav_home"></div>
                        <p class="font-latobold-footer footer-word-home">HOME</p>
                    </a>
                </div>
                <div class="col-3">
                    <a href="#">
                        <div class="nav_btn nav_live"></div>
                        <p class="font-latobold-footer footer-word-live">LIVE</p>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/redeem">
                        <div class="nav_btn nav_redeem"></div>
                        <p class="font-latobold-footer footer-word-redeem">REDEEM</p>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/profile">
                        <div class="nav_btn nav_profile"></div>
                        <p class="font-latobold-footer footer-word-profile">PROFILE</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
    @yield('postscript')
</html>
