@extends('layouts.app')

@section('prescript')
    <style>
        .shade-overlay{
            top: 0;
            left: 5%;
            position:absolute;
            background-image:linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(25,25,25,1) 0%, rgba(255,255,255,0) 50%, rgba(25,25,25,1) 100%);
            height:100%;
            width: 90%;
            pointer-events: none;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid bg-red scroller">
    <div class="row">
        <div class="col-12 header-livestage">
            <img src="{{url('images/livestage-header-text.svg')}}" class="img-fluid banner-header-full p-20"/>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-12">
            <a href="/stream/{{$events->first()->id}}">
                <img class="livestage-thumb px-2" src="{{$events->first()->event_image_url}}">
            </a>
            <div class="shade-overlay"></div>
        </div>
        <div class="col-12 mt-2 mx-3" style="position:absolute;z-index:5;color:white;">
            <p class="font-latobold mb-0 font-size-18px">The hehehe event<img class="pull-right mr-5 pt-1" src="{{url('images/live-icon.svg')}}"></p>
            <p class="font-latoregular"><i class="fa fa-caret-right fa-lg mr-2" aria-hidden="true"></i><span id="count">salad</span></p>
        </div>
    </div>
</div>

@endsection

@section('postscript')
<script>
    $(document).ready(function(){
        $(".nav_live").addClass("active");
        let ip_address = "{{env('SOCKETIO_ADDRESS')}}";
        var socket = io.connect(ip_address);

        socket.on('connect', ()=>{
            socket.emit('getcount', '{{$events->first()->id}}');

        });
        socket.on('receivecount', (count)=>{
            console.log('received');
            console.log(count);
            $('#count').html(count);
        });
    });
</script>
@endsection
