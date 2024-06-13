@extends('layouts.mobile')

@section('prescript')
    <script src="{{url('video.js/dist/video.min.js')}}"></script>
    <link href="{{url('video.js/dist/video-js.css')}}" rel="stylesheet" />
    <script src="{{url('videojs-youtube/dist/Youtube.min.js')}}"></script>
@endsection
@section('content')
<div class="text-white scroller-nofooter" style="width: 100%;">
    <div class="container-fluid px-0">
        <div id="carouselExampleIndicators" class="carousel slide w-100 h-50 bg-black" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($banner as $b)
                
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}"  @if ($loop->index == "0")
                    class="active"
                @else
                    
                @endif></li>
               

                @endforeach
            </ol>
            <div class="carousel-inner">

                @foreach ($banner as $b)
                <div class="carousel-item @if ($i++ == 0)
                    active
                @endif ">
                    <img src="{{$b->banner_image_url}}" class=" w-100" alt="...">
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container-fluid menu-height ">
        <div class="row">
            <div class="bg-white menu-border w-100">
                <div class="col-12 hr-border"></div>
                <div class="col-12 mt-3">
                    <h2 class="font-Montserrat font-color-black font-size-24px mb-0">Live Schedule</h2>
                    <div class="text-left">
                        <hr class="hr-custom">
                    </div>

                    <p class="font-NunitoSans-Regular font-size-16px font-color-black" style="margin-top: -18px;">Every
                        weekday 12PM noon.</p>

                </div>
                <div class="col-12" id="event">
                    @foreach($event as $e)
                    <div class="row py-3 @if ($loop->iteration  % 2 == 1 ) light-yellow-dots-bg bg-yellow-content @endif">
                        <div class="col-7 font-color-black">
                            <p class="font-NunitoSans-ExtraBold font-size-13px mb-1 violet-text-color">
                                {{Str::upper(Carbon\Carbon::parse($e->event_start_date)->format('D, d M Y'))}}</p>
                            <p class="font-Montserrat-SemiBold font-size-16px mb-1">{{$e->event_name}}</p>
                            <div class="btn bg-lime text-black font-NunitoSans-Bold font-size-14px btn-voilet py-1 mt-2 jsOpenDropdown">
                                Details
                                <i class="fa fa-angle-down fa-lg fa-fw" aria-hidden="true"></i>
                            </div>
                        </div>

                        <div class="col-5 my-auto">
                            <img src="{{$e->event_image_url}}" class="img-fluid menu-img" />
                            <div class="text-center w-100 bg-violet FFEF41-color hostname-border p-0">{{$e->event_host_name}}</div>
                        </div>

                        <div class="col-12 view-more" style="display: none;">
                            <div class="input-sharp d-flex mt-3 bg-lime" style="border-style: solid;">
                                <div class="col-6 my-3 text-black font-NunitoSans-ExtraBold">
                                    <p>Hosted by: {{$e->event_host_name}}</p>
                                    <div class="d-flex">
                                        <div class="col p-0">
                                            <div class="view-more-icon bg-fb"></div>
                                        </div>
                                        <div class="col p-0">
                                            <div class="view-more-icon bg-whatsapp"></div>
                                        </div>
                                        <div class="col p-0">
                                            <div class="view-more-icon bg-twitter"></div>
                                        </div>
                                        <div class="col p-0">
                                            <div class="view-more-icon bg-wechat"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-12 hr-border"></div>
            </div>
        </div>

        <div class="row bg-lime">
            <div class="col-md-12 px-0">
                <div class="col-12 mt-3">
                    <h2 class="font-Montserrat font-color-black font-size-24px mb-0">How to Play?</h2>
                    <div class="text-left">
                        <hr class="hr-white">
                    </div>

                    <p class="font-NunitoSans-Regular font-size-16px font-color-black">Want to know how to play to win rewards? Watch here to get ready before the game.<br />Catch us every weekday at 12PM! OnzLAH!</p>

                </div>
            </div>
            <div class="col-12 pb-5 px-3" style="height: 264px; width:640px">
                <!-- <video src="#" class="bg-darker position-relative w-100 h-100"></video> -->
                <video
                    id="video1"
                    class="video-js vjs-fill vjs-big-play-centered input-sharp"
                    controls
                    playsinline
                    preload="auto"
                    width="640"
                    height="264"
                    data-setup='{
                        "techOrder": ["youtube"],
                        "sources": [{ "type": "video/youtube", "src": "https://www.youtube.com/watch?v=8PEuctjIGzo"}],
                        "responsive": ["true"]
                    }'
                >
                </video>
                <!-- <div class="position-absolute play-button-middle">
                    <img src="{{url('/assets2/icon/play-button.png')}}" alt="" id="play_button" onclick="clicked()">
                </div> -->

            </div>
            <div class="col-12 hr-border"></div>

        </div>

        <div class="row bg-yellow-follow-us">
            <div class="col-md-12 px-0">
                <div class="col-12 mt-3">
                    <h2 class="font-Montserrat font-color-black font-size-24px mb-0">Follow Us</h2>
                    <div class="text-left">
                        <hr class="hr-white-2">
                    </div>

                    <p class="font-NunitoSans-Regular font-size-16px font-color-black">Don’t forget to follow our social
                        media to know the latest news of OnzLAH!</p>

                </div>
            </div>

            <div class="col-md-12 text-left p-0">
                <div class="px-3">
                    <a href="https://www.facebook.com/onzlah.live/" class="a-visited-node" target="_blank">
                        <p class="font-size-20px font-NunitoSans-SemiBold text-black">
                            <img src="{{url('/assets2/icon/fbicon2.png')}}" class="mr-20" alt="" width="44" height="44">
                            @onzlah.live
                        </p>
                    </a>
                </div>
                <div class="px-3">
                    <a href="https://www.instagram.com/onzlah.live/" class="a-visited-node" target="_blank">
                        <p class="font-size-20px font-NunitoSans-SemiBold text-black">
                            <img src="{{url('/assets2/icon/IG_Glyph_Fill.png')}}" class="mr-20" alt="" width="44" height="44">
                            @onzlah.live
                        </p>
                    </a>
                </div>
                <div class="px-3">
                    <a href="https://www.youtube.com/channel/UCBSbnWxsEn2ZbNQj4YCcRsA" class="a-visited-node" target="_blank">
                        <p class="font-size-20px font-NunitoSans-SemiBold text-black ">
                            <img src="{{url('/images/youtube-icon.svg')}}" class="mr-20" alt="" width="44" height="44">
                            onzlah.live
                        </p>
                    </a>
                </div>
                <div class="px-3">
                    <a href="https://onzlah.live/" class="a-visited-node" target="_blank">
                        <p class="font-size-20px font-NunitoSans-SemiBold text-black ">
                            <img src="{{url('/images/world-wide-web-icon.svg')}}" class="mr-20" alt="" width="44" height="44">
                            https://onzlah.live/
                        </p>
                    </a>
                </div>
                <div>
                    <img src="{{url('/assets2/img/Group 23188.png')}}" class="w-100 h-100" alt="">
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('postscript')
<script>
    $(document).ready(function () {
        var video = videojs('video1');
        $(".nav_home").addClass("active");
        $(".footer-word-home").addClass("active");

        $(".see-more").click(function () {
            $div = $($(this).data('div')); //div to append
            $link = $(this).data('link'); //current URL

            $page = $(this).data('page'); //get the next page #
            $href = $link + $page; //complete URL
            $.get($href, function (response) { //append data
                $html = $(response).find("#event").html();
                $div.append($html);
            });

            $(this).data('page', (parseInt($page) + 1)); //update page #
        });

        $('#event').on('click','.jsOpenDropdown', (event)=>{
            console.log($(event.currentTarget));
            $(event.currentTarget).parent().siblings('.view-more').fadeToggle();
            $(event.currentTarget).children('i').toggleClass('fa-angle-down fa-angle-up');
        });
        /* $('#event').on('click','.jsCloseDropdown', (event)=>{
            $(event.target).parent().parent().siblings('.view-more').fadeOut();
            $(event.target).parent('.jsCloseDropdown').hide();
            $(event.target).parent().siblings('.jsOpenDropdown').show();
        }); */

    });


    function clicked() {
        $('#play_button').fadeOut();
        //console.log("ss");
    }

</script>
@endsection
