<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <style>
        @media only screen and (max-width: 768px) {
            .web-header-menu {
                display: none;
            }
            .web-header-login {
            }
        }
    </style>
    <style>
        .block-1-onzlah{
            transform: translateY(-81px);
            position:absolute;
            top: 0;
            left: 0;
        }

        .sharpbox-bold{
            border-radius: 0;
            border-width: 6px;
            border-color: black;
            border-style: solid;
        }

        .font-size-42px{
            font-size: 42px;
        }
        .block-1-mobile-image{
            background-image: url('images/website/block-1-mobile.png');
            height: 50rem;
            background-repeat:no-repeat;
            background-size: contain;
        }
        .block-btmleft-image{
            position:absolute;
            bottom:0;
            left: 0;
            background-repeat:no-repeat;
        }
        .block-btmright-image{
            position:absolute;
            bottom:0;
            right: 0;
            background-repeat:no-repeat
        }
        .text-violet{
            color: #7422FF
        }
        .block-2-row-1-margin{
            margin-top: 5rem;
        }
        .margin-top-75rem{
            margin-top: 7.5rem;
        }
        .margin-bottom-75rem{
            margin-bottom: 7.5rem;
        }
        .padding-x-5rem{
            padding-left: 5rem;
            padding-right: 5rem;
        }
        .padding-x-75rem{
            padding-left: 7.5rem;
            padding-right: 7.5rem;
        }
        .padding-x-100rem{
            padding-left: 10rem;
            padding-right: 10rem;
        }
        .padding-x-125rem{
            padding-left: 12.5rem;
            padding-right: 12.5rem;
        }
        .padding-x-150rem{
            padding-left: 15rem;
            padding-right: 15rem;
        }
        .padding-x-200rem{
            padding-left: 20rem;
            padding-right: 20rem;
        }
        .padding-x-300rem{
            padding-left: 30rem;
            padding-right: 30rem;
        }
        .padding-top-100rem{
            padding-top: 10rem;
        }
        .padding-top-50rem{
            padding-top: 5rem;
        }
        .padding-y-50rem{
            padding-top: 5rem;
            padding-bottom: 5rem;
        }
        .padding-top-50rem{
            padding-top: 5rem;
        }
        .margin-bottom-150rem{
            margin-bottom:15rem;
        }
        .margin-bottom-100rem{
            margin-bottom:10rem;
        }
        .margin-bottom-200rem{
            margin-bottom:20rem;
        }
        .margin-bottom-75rem{
            margin-bottom:7.5rem;
        }
        .margin-bottom-50rem{
            margin-bottom:5rem;
        }

        .tnc-scroll{
            max-height: 90vh;
            overflow-x: hidden;
            overflow-y: scroll;
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
            scrollbar-width: thin;
            scrollbar-color:  #747474 #FFEF41;
        }

        .tnc-scroll::-webkit-scrollbar {
            width: 12px;
        }

        .tnc-scroll::-webkit-scrollbar-track {
            background:  #FFEF41;
        }

        .tnc-scroll::-webkit-scrollbar-thumb {
            background-color: #747474;
            width: 25%;
            border-radius: 20px;
            border: 3px solid #FFEF41;
        }

        @media only screen and (max-width: 1440px) {
            .block-btmleft-image {
                display: none;
            }
        }

    </style>
    @yield('prescript')
</head>
<style>

</style>

<body class="">
    <div id="app">
        <div class="container-fluid bg-violet">
            <div class="row text-center p-3">
                <div class="col-lg-6 text-left">
                    <a href="/website-landing"><img src="images/website/header-onzlah-logo.svg" alt="" class="img-fluid"></a>
                </div>
                <div class="offset-1">
                </div>
                <div class="col font-Montserrat-Bold font-size-22px my-auto web-header-menu">
                    <a href="#how-to-play" class="text-white">How to Play</a>
                </div>
                <div class="col font-Montserrat-Bold font-size-22px text-white my-auto web-header-menu">
                    <a href="#FAQ" class="text-white">FAQ</a>
                </div>
                <!-- <div class="col font-Montserrat-Bold font-size-22px text-black my-auto input-sharp bg-yellow-content mx-3 py-1 web-header-login">
                    <a href="/home" class="text-black">Play Now!</a>
                </div> -->
                <div class="col font-Montserrat-Bold font-size-22px text-black my-auto input-sharp bg-yellow-content mx-3 py-1 web-header-menu">
                    <a href="#signup-now" class="text-black">Sign Up</a>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
</body>

@yield('postscript')

</html>
