<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/95f82406d3.js" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link href="{{ asset('css/mdboostrap_css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdboostrap_css/mdb.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdboostrap_css/addons/multi-range.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdboostrap_css/style.css') }}" rel="stylesheet">

    <script src="{{ asset('js/mdbboostrap_js/popper.js')}}"></script>
    <script src="{{ asset('js/mdbboostrap_js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/mdbboostrap_js/mdb.js')}}"></script>

    @yield('scripts')
    <title>Admin</title>
</head>
<style>

</style>

<body >
    <div >
     
        <main style="margin-right:0px !important;margin-left:0px;">
            <div class="container-fluid">
               
                    @yield('contents')
                
            </div>
        </main>

    </div>
</body>



<script>
    $('.website_title').text('Live Stream/Video Event');
</script>

</html>
