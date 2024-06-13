@extends('layouts.app')

@section('prescript')
<script type="text/javascript" src="{{url('/instascan/llqrcode.js')}}"></script>
<script type="text/javascript" src="{{url('/instascan/webqr.js')}}"></script>
<style>
    .popup{
        width: 100%;
    }
    #outdiv{
        width: 100%;
        text-align: center;
        padding-top: 5rem; 
    }
    video{
        width: 80%;
        height: 20rem;
        object-fit: cover;
        border: 5px solid black;
    }
    #main{
        margin: 15px auto;
        background:white;
        overflow: auto;
        width: 100%;
    }
    #mainbody{
        background: white;
        width:100%;
        display:none;
    }
    #v{
        width:320px;
        height:294px;
    }
    #qr-canvas{
        display:none;
    }
    .selector{
        margin:0;
        padding:0;
        cursor:pointer;
        margin-bottom:-5px;
    }
    #result{
        text-align: center;
    }
</style>
@endsection

@section('content')

    @if (session()->has('success'))
        <script>
            Swal.fire({
                title: 'Yay!',
                text: '{{session("success")}}',
                icon: 'success',
                confirmButtonText: 'Yay!'
            })
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{session("error")}}',
                icon: 'error',
                confirmButtonText: 'Okay'
            })
        </script>
    @endif

<div class="scroller w-100">
    <div class="container-fluid main-header-bg">
        <div class="row" style="padding-top:5rem">
            <div class="col-2 text-left pt-2">
                <a href="/main"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a>
            </div>
            <div class="col-8 text-center ">
                <p class="font-Montserrat-ExtraBold font-size-28px FFEF41-color "> SCAN</p>
            </div>
            <div class="col-2 text-center">

            </div>
        </div>
    </div>

    <div class="container-fluid light-white-dots-bg" style="height: 86vh;background-color: #9F81FF" id="screenshot">
        <div class="row">
            <div class="col-md-12 px-0" style="height: 47vh">
                <div class="img-center-content">
                    <div id="qr_code_scanner">
                        <img class="selector" id="webcamimg" src="./qrqrfiles/vid.png" onclick="setwebcam()" align="left" style="opacity: 1; height: 0; width: 0;">
                        <img class="selector" id="qrimg" src="./qrqrfiles/cam.png" onclick="setimg()" align="right" style="opacity: 0.2; height: 0; width: 0;">
                        <div id="outdiv"><video id="v" autoplay=""></video></div>
                        <div id="result">- scanning -</div>
                        <div id="main">
                            <div id="mainbody" style="display: inline;">
                            </div>
                        </div>
                        <canvas id="qr-canvas" width="800" height="600" style="width: 800px; height: 600px;"></canvas>
                    </div>
                    <div id="qr_code_generator" class="qr_code_generator">
                        {!! \QrCode::size(300)->generate(\URL::to('/qr-add-friend/'.Auth::id())) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 text-center py-5">
            <button class="btn bg-yellow-content font-size-30px font-Montserrat-Bold px-5"
                style="border: 4px solid #000 " onclick="show_qr()" id="btn_qr">MY QR CODE</button>
            <button class="btn bg-yellow-content font-size-30px font-Montserrat-Bold px-5"
                style="border: 4px solid #000 " onclick="show_camera()" id="btn_camera">MY CAMERA</button>
        </div>
    </div>
</div>
</div>

@endsection

@section('postscript')

<script>
    
    load();
    $(document).ready(function () {

        /* $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });

             $.ajax({
                 type: "get",
                 url: content,
                 success: function (data) {

                     console.log(data.data);
                     if (data.data == "Both of you already friends") {
                         Swal.fire({
                             title: 'Error!',
                             text: data.data,
                             icon: 'error',
                             confirmButtonText: 'Yes'
                         })
                     } else if (data.data == "Cannot Friend with yourself") {
                         Swal.fire({
                             title: 'Error!',
                             text: data.data,
                             icon: 'error',
                             confirmButtonText: 'Yes'
                         })
                     } else if (data.data == "Not Login") {
                         Swal.fire({
                             title: 'Error!',
                             text: data.data,
                             icon: 'error',
                             confirmButtonText: 'Yes'
                         })
                     } else {
                         Swal.fire({
                             title: 'Success!',
                             text: data.data,
                             icon: 'success',
                             confirmButtonText: 'Yes'
                         })
                     }

                 },
             });
         */
        $('#qr_code_generator').hide();
        $('#btn_camera').hide();
        load();

        
        $('#result').on('change', ()=>{
            console.log('test');
            alert('hehe');
        })
    });

    function show_camera() {
        $('#qr_code_scanner').fadeIn();
        $('#qr_code_generator').hide();
        $('#btn_qr').show();
        $('#btn_camera').hide();
    }

    function show_qr() {
        
        $('#qr_code_scanner').hide();
        $('#qr_code_generator').fadeIn();
        $('#btn_qr').hide();
        $('#btn_camera').show();
    }


    //var parmesan = new RegExp('[\?&]' + 'room' + '=([^&#]*)').exec(window.location.href);

</script>
@endsection
