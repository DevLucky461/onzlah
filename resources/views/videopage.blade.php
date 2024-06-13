 @extends('layouts.app')

@section('prescript')
    <script type="text/javascript" src="{{url('video.js/dist/video.min.js')}}"></script>
    <link href="{{url('video.js/dist/video-js.css')}}" rel="stylesheet" />
    <script type="text/javascript" src="{{url('videojs-youtube/dist/Youtube.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/articles.js')}}" async=""></script>
    <script type="text/javascript" src="{{url('js/profanity.js')}}"></script>
    <style>
    .table td, .table th{
        width: 100%;
    }
    </style>
@endsection

@section('content')

<div class="container-fluid bg-red z-indexer scroller" style="z-index: 1;">
    <div class="row">
        <div class="col-12 p-0 m-0" style="height: calc(100vh - 60px);">
            <video
                id="video1"
                class="video-js vjs-fill"
                playsinline
                preload="auto"
                width="385"
                height="370"
                data-setup='{
                    "sources": [{ "type": "application/x-mpegURL",
                    "src": ""}],
                    "responsive": ["true"]
                }'
            >
            </video>
            <!--
                "techOrder": ["youtube"],
                "sources": [{ "type": "video/youtube", "src": ""}],

                "sources": [{ "type": "application/x-mpegURL",
                "src": "https://livestream.cakexp.com/hls/test.m3u8"}],
            -->
        </div>
    </div>
</div>

<div id='overlay-2' class="container-fluid overlay-2 scroller-overlay" style='display: block; z-index: 2;'>
    <div class="row exit-button">
        <div class="col-4 btn-group" id="exitfs">
            <div class="text-center mr-2 usercount-hud font-Nunito-Sans font-size-16px text-white">
                <i class="fa fa-eye" aria-hidden="true"></i><span class="ml-2" id="roomcount">0</span>
            </div>
            <br>
            <div class="text-center mr-2 usercount-hud font-Nunito-Sans font-size-16px text-white">
                <i class="fa fa-gift" aria-hidden="true"></i><span class="ml-2" id="litcount">{{$stickercount->sum()}}</span>
            </div>
        </div>
    </div>
    <div id="fade-row" class="row overlay-2-fade">
        <div class="col-9" id="chat-col">
            <div id="chat-container" class="container-fluid chat-inputbox-height">
                <div class="row user-connected-pos">
                    <div class="col-12 my-2">
                        <div id="user-connected" class="sticker-announce font-italic" style="display:none;">none</div>
                    </div>
                </div>
                <div class="row chat-overlay-pos" id="chatbox">
                </div>
                <div id="reply-to" class="row chat-reply-pos" style="display:none; z-index:0;">
                    <div id="reply-text" class="col-12 font-italic reply-overlay">Replying to person A</div>
                </div>
                <div class="row chatinput-overlay-pos text-center">
                    <div class="col-9 pt-4 px-0">
                        <input type='text' id='chatinput' class='form-control button-border-custom' placeholder='Say something...'>
                    </div>
                    <div class="col-3 pt-4 px-0">
                        <button id="send-message" class="button-send-chat font-Montserrat">SEND</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-3" id="menu-col">
            <div class="container-fluid chat-inputbox-height">
                <div class="row sidenav-overlay-pos">
                    {{-- <div class="col-12 mb-3">
                        <img src="{{url('images/livestream/ellipses.png')}}" id="show-question" class="img-fluid p-1 cursor-pointer">
                    </div> --}}

                    <div class="col-12 mb-3">
                        <img src="{{url('images/livestream/ellipses.png')}}" id="button-ellipses" class="img-fluid p-1 cursor-pointer">
                    </div>
                    <div class="col-12 my-3">
                        <img src="{{url('images/livestream/arrow-right.png')}}" id="button-arrow" class="img-fluid p-1 cursor-pointer">
                    </div>
                    <div class="col-12 mt-3">
                        <img src="{{url('images/livestream/giftbox.png')}}" id="button-gift" class="img-fluid p-1 cursor-pointer">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="overlay-3" class="scroller-overlay container-fluid gift-overlay-pos text-center" style="z-index: 0; display:none;">
    <div class="row">
        <div class="col-10 text-left pt-4">
            <p class="font-Montserrat font-size-20px">Gift</p>
        </div>
        <div class="col-2 pt-4">
            <button id='gift-exit' class='btn btn-exit input-sharp font-NunitoSans-ExtraBold'><img src="{{url('images/close-icon.svg')}}"></button>
        </div>
    </div>
    <div class="row row-border-bottom row-gift-scroll flex-row flex-nowrap" id="sticker-button">
        @foreach($sticker as $s)
        <div class="col-3 px-0">
            <label class="">
                <input type="radio" name="sticker-option" class="sticker-noborder w-100 radio-hidden" value="{{$s->id}}">
                    <div class="sticker" style="background-image: url('{{$s->src}}')"></div>
                    <p class="mb-0 font-latobold font-size-13px">{{$s->sticker_name}}</p>
                    <p class="font-latoregular font-size-11px font-color-gray" id="sticker-cost">{{$s->sticker_cost}}</p>
                <input type="hidden" value="{{$s->id}}" id="sticker_id">
            </label>
        </div>
        @endforeach
    </div>
    <div class="row coin my-4">
        <div class="col-5 text-left my-auto">
            <p class="m-0"><img src="{{url('images/coin-icon.svg')}}"><span id="coin-balance"> {{(auth()->user()->coins)}}</span></p>
        </div>
        <div class="col-3 text-right pr-0">
            {{-- <button class="btn btn-light font-size-25px" id="minus"> - </button>
            <button class="btn btn-light font-latobold" id="counter"> 1 </button>
            <button class="btn btn-light font-size-25px" id="plus"> + </button> --}}
            <input type="hidden" id='counter' value='1'>
        </div>
        <div class="col-4">
            <button id="send-gift" class="btn button-gray-nostock font-Montserrat-Bold font-size-18px py-1" disabled>SEND</button>
        </div>
    </div>
</div>


<div id="overlay-4" class="container-fluid question-overlay-pos text-center scroller-overlay" style="z-index: 0; display: none;">
    <div class="row h-100">
        <div class="col-12 px-0">
            <div id="questioncard" class="card question-card w-100 h-100 mb-4 pb-3">
                <div id="question-card" class="card-body">
                    <div class="container-fluid" id="question-container">
                        <div class="row text-center">
                            <button id='status-box' class="button-border-custom font-markerfeltwide font-size-18px status-box-correct" style="display: none">
                            </button>
                        </div>
                        <div class="row mb-3">
                            <div id="result-text" class="col-12 font-Montserrat-Bold font-size-20px mt-3 px-0">
                            </div>
                        </div>
                        <div class="row text-center" id="revive">

                        </div>
                        <div class="row">
                            <div id="question-number" class="col-6 text-left align-self-center font-Montserrat-Bold font-size-16px font-color-gray">
                                Question <span id="current-question"></span>/8
                            </div>
                            <div class="col-6 text-right">
                                <button id='timerbox' class='btn timerbox font-Montserrat-Bold font-size-18px status-box-pos'><span id='timersec'>10</span></button>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div id="question-text" class="col-12 font-Montserrat-Bold font-size-18px py-0">
                                @isset($currentquestion->question)
                                {{$currentquestion->question}}
                                @endisset
                                @empty($currentquestion->question)
                                No Question
                                @endempty
                            </div>
                        </div>
                        <div class="row mt-1" id="answers">
                            @isset($currentquestion)
                            @foreach($currentquestion->answer as $a)
                            <div class="col-12 mb-1">
                                <button class="text-left answerbox font-Nunito-Sans font-size-18px d-flex">
                                    <div class="col-2 px-0 align-self-center">
                                        {{chr($loop->index + 65)}}
                                    </div>
                                    <div class="col-7 p-0 align-self-center">
                                        {{$a->answer}}
                                    </div>
                                    <div class="col-3 px-0 answer-percentage align-self-center">
                                    </div>
                                </button>
                            </div>
                            @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>

            <div id='revivecard' class="card question-card question-margin mb-4" style="display: none">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row font-Montserrat-Bold font-size-19px">
                            <div class="col-6 text-left">
                                <img class="mw-25" src="{{url('img/life.png')}}" /> <span id="initial-life">{{auth()->user()->life}}</span>
                            </div>
                            <div class="col-6">
                                <div class="pull-right">
                                    <div class="life-box-1" id="life-box-1"></div>
                                    <div class="life-box-2" id="life-box-2"></div>
                                    <div class="life-box-3" id="life-box-3"></div>
                                    <span id="used-life">0/3</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="font-bold font-size-16px">To continue the quiz after you answered wrong, you can revive maximum 3 times in a round using your Life.</p>
                                <p class="font-bold font-size-18px">Are you sure you want to use <span class="font-color-orange">1</span> Life to revive your journey?</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button id='uselife-yes' class="btn button-yes font-komikaaxis font-size-13px text-white">
                                    <img src="{{url('images/livestream/life-tick.svg')}}" />
                                </button>
                                <button id='uselife-no' class="btn button-no font-komikaaxis font-size-13px text-white">
                                    <img src="{{url('images/livestream/life-cross.svg')}}" />
                                </button>
                            </div>
                            <div class="col-12 text-center mt-3">
                                <p class="font-Montserrat font-italic mt-10 font-size-12px">This window will automatically close in 10 seconds.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id='revive-after' class="card question-card question-margin mb-4" style="display: none">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6 text-left">
                                <img class="mw-25" src="{{url('img/life.png')}}" /> <span id="current-life">{{auth()->user()->life}}</span>
                            </div>
                            <div class="col-6">
                                <div class="pull-right">
                                    <div class="life-box-1" id="life-box-1"></div>
                                    <div class="life-box-2" id="life-box-2"></div>
                                    <div class="life-box-3" id="life-box-3"></div>
                                    <span id="current-used-life">0/3</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="font-bold font-size-16px">You have respawned.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="overlay-5" class="container-fluid scroller-overlay" style="z-index: 0; height:calc(100vh - 60px)">
    <div class="row">
        <div class="col-12" id="sticker-start" style="height:100vh">
        </div>
    </div>
</div>

<div id="overlay-6" class="container-fluid question-overlay-pos text-center scroller-overlay" style="z-index: 0; display: none;">
    <div class="row">
        <div class="col-12">
            <div class="card scoreboard-card question-margin mb-4">
                <div id='scoreboard-card' class="card-body splash-bg">
                    <div class="container-fluid" id="scoreboard-container">
                        <div class="row mt-4">
                            <div class="col-12">
                                <img id="balloon-img" class="img w-100" src="{{url('images/livestream/winner-balloon.png')}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 font-Montserrat-Bold font-size-18px">
                                <p id="congrats-message" class="mb-1">You have just won</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div id="prize-amount" class="btn font-Montserrat-ExtraBold font-size-25px input-sharp bg-violet text-white">
                                    whatever amount
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid" id="scoreboard-container-2nd" style="display:none;">
                        <div class="row pb-3">
                            <div class="col-12">
                                <table class="table">
                                    <thead class='font-markerfelt'>
                                        <tr class="table-border-bottom d-flex font-size-28px text-center">
                                            <th class="col-12" style="border: unset">Winner List</th>
                                        </tr>
                                    </thead>
                                    <tbody class='font-markerfelt'>
                                        <tr class="table-border-bottom d-flex text-center" >
                                            <td id="winnerlist" class="row"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="overlay-7" class="scroller-overlay container-fluid gift-overlay-pos text-center pb-5 px-5" style="z-index: 0; display:none;">
    <div class="row">
        <div class="col-10 text-center pt-4">
            <p class="font-komikaaxis font-size-20px">Share</p>
        </div>
        <div class="col-2 pt-4">
            <button id='subscribe-exit' class='btn btn-exit input-sharp font-NunitoSans-ExtraBold'><img src="{{url('images/close-icon.svg')}}"></button>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col p-0">
            <a class="js-sharing-popup-facebook cursor-pointer display-block"
                data-share-url="https://www.onzlah.live/">
                <div class="share-button-fb">
                </div>
            </a>
        </div>
        <div class="col p-0">
            <a class="display-block"
                href="whatsapp://send?text=Onzlah is live! Join us on Facebook live now at https://www.onzlah.live/ !"
                data-action="share/whatsapp/share">
                <div class="share-button-whatsapp">
                </div>
            </a>
        </div>
        <div class="col p-0">
            <a class="js-sharing-popup-twitter cursor-pointer display-block"
                data-share-text="Onzlah is live! Join us on Facebook live now!"
                data-share-url="https://www.onzlah.live/"
                data-share-via=""
                data-share-hashtags="Onzlah,PlayEarnSpend"
                data-share-related="">
                <div class="share-button-twitter">
                </div>
            </a>
        </div>
        <!-- <div class="col p-0">
            <a class="display-block"
                href="#">
                <div class="share-button-wechat">
                </div>
            </a>
        </div> -->
        <div class="col p-0">
            <a class="js-sharing-copy-link cursor-pointer display-block"
                data-copy-message="Press #{key} to copy link."
                data-copy-label="Link copied to clipboard">
                <div class="share-button-copylink">
                </div>
            </a>
        </div>
    </div>
</div>

<div id="overlay-8" class="scroller-overlay container-fluid gift-overlay-pos" style="z-index: 0; display:none;">
    <div class="row">
        <div class="offset-10 col-2 pt-4">
            <button id='setting-exit' class='btn btn-exit input-sharp font-NunitoSans-ExtraBold'><img src="{{url('images/close-icon.svg')}}"></button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 ml-20">
            <div class="form-check my-3">
                <label class="form-check-label label-checkbox font-size-20px">Disable Chat
                    <input id="disable-chat" type="checkbox" class="pull-right form-check-input font-NunitoSans-ExtraBold font-size-18px checkbox-hide" value="">
                    <span class="form-check-input font-Nunito-Sans checkbox-live"></span>
                </label>
            </div>
            <div class="form-check my-3">
                <label class="form-check-label label-checkbox font-size-20px">Disable Sticker Effect
                    <input id="disable-sticker" type="checkbox" class="pull-right form-check-input font-NunitoSans-ExtraBold font-size-18px checkbox-hide" value="">
                    <span class="form-check-input font-Nunito-Sans checkbox-live"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr class="overlay-8-hr">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="form-check-label label-checkbox pb-20 font-size-20px">Your Lives: <img src="{{url('/img/life.png')}}" width="25" height="25"><span id="life-number">{{auth()->user()->life}}</span></p>
        </div>
    </div>
</div>

<div id="overlay-9" class="scroller-overlay-nofooter container-fluid scroller bg-violet top-and-bot-white-dots" style="z-index: 50;">

    <div class="onzlah-splash-logo text-center">
        <img class="img-center-content" src="{{url('images/onzlah-logo-png.png')}}">
        <div class="font-Montserrat-Bold font-size-25px text-white">LIVE is ongoing now!</div>
    </div>
    <div class="px-3">
        <a class="btn button-yellow font-Montserrat font-size-30px my-5" id="play-video" href="#">CLICK TO JOIN</a>
    </div>
</div>




@endsection

@section('postscript')
<script>

    $(document).ready(function(){

        console.log('event id: {{$event->id}}');
        $(".nav_live").addClass("active");
        let user_id = "{{auth()->user()->id}}";
        let user_name = "{{auth()->user()->name}}";
        let ip_address = "{{env('SOCKETIO_ADDRESS')}}";
        let stream_id = '{{$event["id"]}}';
        var socket = io.connect(ip_address);
        var scoreboard_timeout;
        var question_timeout;

        //--- Chat load section ---//

        var chatobj = {!!$message!!};
        var bwlist = [
            'bitch',
            'fuck',
            'ccb',
            'pukimak',
            'puki',
            'pukima',
            'cibai',
            'jibai',
            'babi',
            'cunt',
        ];

        function wordFilter(text){
            var currenttext = text;
            var ast = '*';
            $.each(bwlist, function(i){
                currenttext = currenttext.replace(bwlist[i], ast.repeat(bwlist[i].length));
            });
            return currenttext;
        }

        function printChatText(textmsg){
            if (textmsg.users.id == user_id){
                $('#chatbox').append($('<div/>').addClass('col-12 mt-2 text-left chat-text-lineheight')
                    .append($('<span/>').addClass('jsUsername').html('You'))
                    .append($('<span/>').addClass('jsUsertext').html(' : '+wordFilter(textmsg.message)))
                );
            }
            else {
                $('#chatbox').append($('<div/>').addClass('col-12 mt-2 text-left chat-text-lineheight jsReply')
                    .append($('<span/>').addClass('jsUsername').html(textmsg.users.name))
                    .append($('<span/>').addClass('jsUsertext').html(' : '+wordFilter(textmsg.message)))
                );
            }
        }

        $.each(chatobj, (i)=>{
            printChatText(chatobj[i]);
        });

        //--- End chat load section ---//


        socket.on("connect", function(){
                socket.emit("user_connected", user_id, stream_id, user_name,'user','web');
        });

        socket.on("user enter the chat", function(user_name){
            $('#user-connected').html( user_name + " has entered the chat").fadeIn();
            setTimeout(()=>{$('#user-connected').fadeOut()},5000);
        });
        socket.on("user-disconnects", function(user_name){
            $('#user-connected').html( user_name + " has left the chat").fadeIn();
            setTimeout(()=>{$('#user-connected').fadeOut()},5000);
        });

        socket.on("messages", function(message){
            console.log(message);
            console.log({{ Auth::user()->id}});
            if(message.user_id != {{ Auth::user()->id}}){

                $('#chatbox').append($('<div/>').addClass('col-12 mt-2 text-left chat-text-lineheight jsReply')
                    .append($('<span/>').addClass('jsUsername').html(message.sender_name))
                    .append($('<span/>').addClass('jsUsertext').html(' : '+wordFilter(message.message)))
                );
            }
            $('#chatbox').scrollTop(document.getElementById('chatbox').scrollHeight);

        })

        socket.on("pop-quiz", function(){
            console.log('quiz is popped');
            clearTimeout(question_timeout);
            fireQuiz();
            console.log('quiz is posted');
        })

        socket.on("pop-result", function(data){
            console.log('result is popped');
            $('#overlay-4').fadeIn().css('z-index', '75');
            $.ajax({
                url: "{{ url('/get-score-percentage') }}",
                method: 'post',
                data: {
                    "question_id" : data,
                },
                success: function (response) {
                    $('#answers').find('.answer-percentage').each(function(index){
                        $(this).html(response.percentage[index]);
                    });
                }
            });
            clearTimeout(question_timeout);
            question_timeout = setTimeout(()=>{$('#overlay-4').fadeOut().css('z-index', '0')}, 10000);
        })
        socket.on("pop-scoreboard", function(user_id, prize_money){

            $.ajax({
                url: "{{ url('/get-winnerlist') }}",
                method: 'post',
                data: {
                },
                success: function (response) {
                    if (response.list != "none"){
                        console.log(response.list.length);
                        $('#winnerlist').empty()
                        for (i = 0; i < response.list.length; i++){
                            $('#winnerlist')
                                    .append($('<div>').addClass('col-6 font-size-20px question-panel').css('border-top','unset').html(response.list[i])
                                )
                        }
                    }
                }
            });

            if ($.inArray({{auth()->id()}},user_id) != -1){
                console.log('you are one of the winner');
                $('#scoreboard-card').addClass('winner-bg')
                $('#prize-amount').html(numFormat(prize_money)+' Coins');
                $('#overlay-6').fadeIn().css('z-index', '25');
                setTimeout(()=>{
                    $('#scoreboard-container').fadeOut(400,()=>{
                        $('#scoreboard-container-2nd').fadeIn();
                    })
                },10000)
            }
            else {
                console.log('you are one of the losers');
                $('#scoreboard-card').addClass('loser-bg')
                $('#balloon-img').attr('src', '{{url("images/livestream/loser-balloon.png")}}')
                $('#congrats-message').html('Sorry, you did not win');
                $('#prize-amount').html('Better luck next time');
                $('#overlay-6').fadeIn().css('z-index', '25');
                setTimeout(()=>{
                    $('#scoreboard-container').fadeOut(400,()=>{
                        $('#scoreboard-container-2nd').fadeIn();
                    })
                },10000)
            }
            clearTimeout(scoreboard_timeout);
            scoreboard_timeout = setTimeout(()=>{$('#overlay-6').fadeOut().css('z-index', '0')}, 20000);
        })

        socket.on('receivecount', (count)=>{
            console.log('received');
            $('#roomcount').html(count);
        });

        $('#chatbox').scrollTop(document.getElementById('chatbox').scrollHeight);

        //this is UI section ---------------------------------------------


        var video = videojs('video1'{}, function(){
                        this.src({type: 'video/mp4', src: 'https://livestream.cakexp.com/hls/onzlah.m3u8?play=true?time={{time()}}'});
                    });
        video.fluid(false);
        $('#play-video').on('click', ()=>{
            $('#overlay-9').fadeOut(1000);
            video.play();
            console.log('played');
        });/*
        video.ready(function() {
            var promise = video.play();

            if (promise !== undefined) {
                promise.then(function() {
                // Autoplay started!
                }).catch(function(error) {
                // Autoplay was prevented.
                });
            }
        }); */
        $('#chatinput').on('keypress', function(e){
            if(e.which == 13) {
                printMessage();
            }
        })
        $('#send-message').on('click', function(){
            printMessage();
        })
        function printMessage(){
            if($('#chatinput').val() != ''){

                if($('#reply-to').is(':visible')){
                    $('#chatbox').append($('<div/>').addClass('col-12 mt-2 text-left chat-text-lineheight')
                        .append($('<span/>').addClass('jsUsername').html('You'))
                        .append($('<span/>').addClass('jsUsertext').html(' : '+ wordFilter('@'+$('#reply-target').html()+' '+$('#chatinput').val())))
                    );
                    $('#reply-to').slideToggle('fast');
                    sendMessage('@'+$('#reply-target').html()+' '+$('#chatinput').val());
                }

                else {
                    $('#chatbox').append($('<div/>').addClass('col-12 mt-2 text-left chat-text-lineheight')
                        .append($('<span/>').addClass('jsUsername').html('You'))
                        .append($('<span/>').addClass('jsUsertext').html(' : '+ wordFilter($('#chatinput').val())))
                    );
                    sendMessage($('#chatinput').val());
                }


                $('#chatinput').val('');
                $('#chatbox').scrollTop(document.getElementById('chatbox').scrollHeight);
            }
        }



        function sendMessage(message){
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/send-message') }}",
                    method: 'post',
                    data: {
                        "message" : message,
                        "video_id" : stream_id,
                    },
                    success: function (response) {
                        //console.log(response.data);
                    }
                });
        }

        //debug button

        $('#show-question').on('click', ()=>{
            $('#overlay-4').fadeIn().css('z-index', '75');
        })

        //end debug button

        $('#button-gift').on('click',function(){
            $('#overlay-3').css('z-index', '30').slideToggle('fast');
        })

        $('#gift-exit').on('click',function(){
            $('#overlay-3').slideToggle('fast',function(){
                $(this).css('z-index', '0');
            });
        })

        $('#button-arrow').on('click',function(){
            $('#overlay-7').css('z-index', '30').slideToggle('fast');
        })

        $('#subscribe-exit').on('click',function(){
            $('#overlay-7').slideToggle('fast',function(){
                $(this).css('z-index', '0');
            });
        })

        $('#button-ellipses').on('click',function(){
            $('#overlay-8').css('z-index', '30').slideToggle('fast');
        })

        $('#setting-exit').on('click',function(){
            $('#overlay-8').slideToggle('fast',function(){
                $(this).css('z-index', '0');
            });
        })

        $('#question-card').on('click', function(e) {
            e.stopPropagation();
        });

        $('#overlay-4').on('click', function () {
            $(this).fadeOut(function(){
                $(this).css('z-index', '0');
            });
        });

        $('#scoreboard-card').on('click', function(e) {
            e.stopPropagation();
        });

        $('#overlay-6').on('click', function () {
            $(this).fadeOut(function(){
                $(this).css('z-index', '0');
            });
            state = 'off';
        });

        var img_link = "";
        var sticker_id = "";
        var sticker_cost = "";
        var stickername = "";

        $('#sticker-button').on('click','div.col-3',function(){
            $('#counter').val(1);
            if($(this).find('#sticker-cost').html() > {{auth()->user()->coins}}) var a = 'cost is higher'; else var a = 'cost is lower';
            img_link = $(this).find('.sticker').css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
            sticker_id = $(this).find('input').val();
            stickername = $(this).find('p').first().html();
            $('#sticker-button').find('div.col-3').removeClass('label-selected');
            $(this).addClass('label-selected');
            console.log('Sticker cost: '+parseInt($('.label-selected').find('#sticker-cost').html()) );
            console.log('Current coin: '+parseInt($('#coin-balance').html()) );
            console.log("Sticker cost more?: "+(parseInt($('.label-selected').find('#sticker-cost').html()) > parseInt($('#coin-balance').html())));

            if (parseInt($('.label-selected').find('#sticker-cost').html()) > parseInt($('#coin-balance').html())){
                console.log('i disable button');
                $('#send-gift').removeClass('button-yellow-small').addClass('button-gray-nostock').attr('disabled', 'disabled');
            }
            else {
                console.log('i enable button');
                $('#send-gift').removeClass('button-gray-nostock').addClass('button-yellow-small').attr('disabled', false);
            }
        });

        // sticker quantity counter - myr

        /* $('#plus').on('click', function(){

            if($('.label-selected').find('#sticker-cost').html() * ($('#counter').html() + 1) > {{auth()->user()->coins}})
            {
                $('#tooltiptext').removeClass('tooltiptext-hide').addClass('tooltiptext-show');
                setTimeout(function(){
                    $('#tooltiptext').removeClass('tooltiptext-show').addClass('tooltiptext-hide');
                }, 3000);
            }

            else{
            $("#counter").html(parseInt($("#counter").html()) + 1);
                console.log($('.label-selected').find('#sticker-cost').html() * $('#counter').html());
            }
        }); */

        /* $('#minus').on('click', function(){
            if ($("#counter").html() > 1) {
                $("#counter").html(parseInt($("#counter").html()) - 1);
                console.log($('.label-selected').find('#sticker-cost').html()+" x "+ $('#counter').html() +" = "+$('.label-selected').find('#sticker-cost').html() * $('#counter').html());
            }
        }); */

        $('#send-gift').on('click', function(){

            var stickcount =  $('#counter').val();
            var username = '{{auth()->user()->name}}';
            socket.emit('send-sticker', {img_link,stickcount,username,stickername});

            $.ajax({
                type: "POST",
                url: '/sticker-update',
                data: {
                    "sticker_id":sticker_id,
                    "event_id":{{$event->id}},
                    "quantity":$('#counter').val(),
                },
            });
            $('#coin-balance').html(parseInt($('#coin-balance').html()) - parseInt($('.label-selected').find('#sticker-cost').html()));
            if (parseInt($('.label-selected').find('#sticker-cost').html()) > parseInt($('#coin-balance').html())){
                $('#send-gift').removeClass('button-yellow-small').addClass('button-gray-nostock').attr('disabled', 'disabled');
            }
        });


        socket.on('receive-sticker', (data)=>{
            $('#litcount').html(parseInt($('#litcount').html()) + parseInt(data.stickcount));
            /* $('#chatbox').append($('<div/>').addClass('col-12 my-2 sticker-announce font-italic').html( data.username + " has sent a "+data.stickername+" to the host"));
            $('#chatbox').scrollTop(document.getElementById('chatbox').scrollHeight); */
            for (i = 0; i < data.stickcount; i++){
                $('#sticker-start').append($('<img/>').attr('src', data.img_link).css({'max-height': '50px', 'max-width': '50px', 'top':'100vh', 'left':Math.floor((Math.random() * 100) + 1)+'%', 'position':'absolute'}).animate({top: "-100vh"}, 10000,function(){$(this).remove()}));
                $('#overlay-5').css({'z-index': '35', 'pointer-events': 'none'});
            }
        });

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });



        /* var sstate;

        function stickercheck() {
            $.ajax({
                type: "POST",
                url: '/sticker-check',
                data: {
                    "event_id":{{$event->id}},
                },
                success: function(response){
                    for (i = 0; i < sstate.length; i++){
                        if(response.sticker_state[i].quantity - sstate[i].quantity != 0){
                            for (j = 0; j < response.sticker_state[i].quantity - sstate[i].quantity; j++){
                                $('#sticker-start').append($('<img/>').attr('src', sstate[i].sticker.src).css({'height': '50px', 'width': '50px', 'top':'100vh', 'left':Math.floor((Math.random() * 100) + 1)+'%', 'position':'absolute'}).animate({top: "-100vh"}, 10000,function(){$(this).remove()}));
                                $('#overlay-5').css({'z-index': '35', 'pointer-events': 'none'});
                            }
                        }
                    }
                    sstate = response.sticker_state;
                }
            });
        }
        function initcheck() {
            $.ajax({
                type: "POST",
                url: '/sticker-check',
                data: {
                    "event_id":{{$event->id}},
                },
                success: function(response){
                    sstate = response.sticker_state;
                }
            });
        }

        initcheck();

        setInterval(function(){
            stickercheck();
        },2000);
 */
        var state = 'off';
        var scorestate ='off';
        var initinterval;
        initinterval = setInterval(function(){
            $.ajax({
                    type: "POST",
                    url: '{{url("/init-state")}}',
                    dataType: 'json',
                    data: {
                        'event_id': '{{$event->id}}',
                    },
                    success: function(){
                        console.log('cleared');
                        clearInterval(initinterval);
                    }
            });
        }, 2000);

        fireQuiz();


        function fireQuiz(){
            $('#result-text').empty();
            $('#timerbox').show();
            $('#overlay-4').off('click');
            $.ajax({
                type: "POST",
                url: '{{url("/quiz-state")}}',
                dataType: 'json',
                data: {
                    'event_id': '{{$event->id}}',
                },
                success: function(response){
                    $('#current-question').html(response.order);
                    /* if (response.status == 'SCOREBOARD' && state == 'off' && scorestate == 'off'){
                        console.log('showing scoreboard');
                        $('#status-box').hide();
                        $('#overlay-6').fadeToggle().css('z-index', '25');
                        state = 'on';
                        scorestate = 'on';
                        for (i = 0; i < response.winner.length; i++){
                            $('#scoreboard-names').append($('<tr/>').addClass("d-flex text-center")
                                .append($('<td/>').addClass('col-6 font-size-20px').html(response.winner[i].user.name))
                                .append($('<td/>').addClass('col-6 font-size-20px').html(response.prize))
                            )
                        }
                    }

                    else if (response.status == 'NO WINNER'  && state == 'off' && scorestate == 'off'){
                        $('#status-box').hide();
                        $('#overlay-6').fadeToggle().css('z-index', '25');
                        state = 'on';
                        scorestate = 'on';
                        $('#scoreboard-names').append($('<p/>').html("Sorry, no winner"));
                    } */

                    if (response.status != 'ERROR' && state == 'off'){
                        console.log('hehe');
                        $('#status-box').hide();
                        $('#timersec').html(response.currenttime);
                        //$('#timersec').html('3');
                        var a = setInterval(function(){
                            if($('#timersec').html() == 0){
                                $('#overlay-4').fadeOut(400, ()=>{
                                    clearInterval(a);
                                    $('.answerbox').not('.answer-select').attr('disabled', 'disabled');
                                    state = 'off';
                                    var answer = '';
                                    var life;
                                    console.log($('.answer-select').siblings('input').val());
                                    console.log('question id: '+response.question.id);
                                    $.ajax({
                                        type: "POST",
                                        url: '{{url("/score-update")}}',
                                        dataType: 'json',
                                        data: {
                                            'event_id': '{{$event->id}}',
                                            'user_id': '{{auth()->id()}}',
                                            'answer_id': $('.answer-select').siblings('input').val(),
                                            'question_id': response.question.id,
                                        },
                                        success: function(e){
                                            answer = e.stats;
                                            if (e.user_status != 'disabled'){
                                                if(answer == 'correct'){
                                                    $('#status-box').empty();
                                                    $('#status-box').removeClass('status-box-correct status-box-wrong').addClass('status-box-correct').append('<i class="fa fa-check fa-2x" aria-hidden="true"></i>').show();
                                                    $('.answer-select').removeClass('answer-select').addClass('answer-correct');
                                                    $('#result-text').html('Yes! You got it right!');
                                                }
                                                else if (answer == 'blocked'){
                                                    $('#status-box').empty().hide();
                                                    $('#answers').find('input').each(function(index){
                                                        if ($(this).val() == e.correct_answer.answer[0].id) {
                                                            $(this).siblings('button').addClass('answer-correct');
                                                        }
                                                    });
                                                    $('#answers').find('input[value='+e.correct_answer.answer[0].id+']').siblings('button').addClass('answer-correct');
                                                    $('.answer-select').removeClass('answer-select').addClass('answer-correct');
                                                    $('#result-text').empty();
                                                    $('#result-text').append($('<span/>').addClass('col-12 font-latobold font-size-18px').html('Sorry, you are disqualified. You are further prevented from answering the questions.'))
                                                }

                                                else if (answer == 'wrong' && e.user_order == '8'){
                                                    $('#status-box').empty();
                                                    $('#status-box').removeClass('status-box-correct status-box-wrong').addClass('status-box-wrong').append('<i class="fa fa-times fa-2x" aria-hidden="true"></i>').show();
                                                    $('.answer-select').removeClass('answer-select').addClass('answer-wrong');
                                                    $('#revive').empty();
                                                    $('#revive').append($('<span/>').addClass('col-12 font-latobold font-size-18px').html('Oh no, you have got the last question wrong. You are not allowed to revive on the last question.'));
                                                }

                                                else if (answer == 'wrong' && e.life > 0 && e.used_life < 3){
                                                    $('#status-box').empty();
                                                    $('#status-box').removeClass('status-box-correct status-box-wrong').addClass('status-box-wrong').append('<i class="fa fa-times fa-2x" aria-hidden="true"></i>').show();
                                                    $('#answers').find('input').each(function(index){
                                                        if ($(this).val() == e.correct_answer.answer[0].id) {
                                                            $(this).siblings('button').addClass('answer-correct');
                                                        }
                                                    });
                                                    $('.answer-select').removeClass('answer-select').addClass('answer-wrong');
                                                    $('#result-text').empty();
                                                    $('#result-text').html('Oh no, you got it wrong!');
                                                    $('#revive').empty();
                                                    $('#revive')
                                                        .append($('<hr>'))
                                                        /* .append($('<div/>').addClass('col-12 text-left my-3')
                                                            .append($('<img>').addClass('h-75').attr('src',"{{url('img/life.png')}}"))
                                                            .append($('<span/>').addClass('ml-2 font-Montserrat-Bold font-size-25px').html($('#current-life').html()))
                                                        ) */
                                                        .append($('<p/>').addClass('col-12 font-NunitoSans-ExtraBold font-size-14px mb-0').html('Sorry, your journey ends here.'))
                                                        .append($('<p/>').addClass('col-12 font-Montserrat-Bold font-size-20px mb-5 revive-text').html('Click here to revive NOW!').attr('id', 'life-button').css('cursor','pointer'))

                                                    $('#life-button').on('click',function(){
                                                        clearTimeout(question_timeout);
                                                        $('#questioncard').fadeOut();
                                                        $('#status-box').fadeOut(()=>{
                                                            $('#revivecard').fadeIn();
                                                        });
                                                    });
                                                }

                                                else if (answer == 'wrong' && e.used_life >= 3){
                                                    $('#status-box').empty();
                                                    $('#status-box').removeClass('status-box-correct status-box-wrong').addClass('status-box-wrong').append('<i class="fa fa-times fa-2x" aria-hidden="true"></i>').show();
                                                    $('.answer-select').removeClass('answer-select').addClass('answer-wrong');
                                                    $('#revive').empty();
                                                    $('#revive').append($('<span/>').addClass('col-12 font-latobold font-size-18px').html('Sorry, you have used maximum allowed revives. Please try again on our next stream!'));
                                                }
                                                else if (answer == 'wrong' && e.life <= 0){
                                                    $('#status-box').empty();
                                                    $('#status-box').removeClass('status-box-correct status-box-wrong').addClass('status-box-wrong').append('<i class="fa fa-times fa-2x" aria-hidden="true"></i>').show();
                                                    $('.answer-select').removeClass('answer-select').addClass('answer-wrong');
                                                    $('#revive')
                                                        .append($('<span/>').addClass('col-12 font-latobold font-size-18px').html('You answered wrongly :( You have got no life left sadly'))
                                                }
                                            }
                                            else {
                                                $('#answers').find('input').each(function(index){
                                                    if ($(this).val() == e.correct_answer.answer[0].id) {
                                                        $(this).siblings('button').addClass('answer-correct');
                                                    }
                                                });
                                                $('#answers').find('input[value='+e.correct_answer.answer[0].id+']').siblings('button').addClass('answer-correct');
                                            }
                                        }
                                    });
                                });
                                $('#overlay-4').on('click', function () {
                                    $(this).fadeOut(function(){
                                        $(this).css('z-index', '0');
                                    });
                                });
                                $('#timerbox').hide();
                            }
                            else $('#timersec').html($('#timersec').html() - 1);
                        },1000);
                        state = 'on';
                        $('#question-text').empty();
                        console.log(response.question.question_type);

                        if(response.question.question_type == 'text'){
                            $('#question-text').addClass('mb-0 text-left').html(response.question.question);
                        }
                        /* else if(response.question.question_type == 'image'){
                            console.log(response.image_list);
                            for(i = 0; i < response.image_list.length; i++){
                                $('#question-text')
                                    .append($('<img/>').attr('src', response.image_list[i]).addClass('img-fluid m-1 input-sharp question-image').css({'height' : '7rem', 'width' : '45%'})
                                );
                            }

                            $('#question-text')
                                .append($('<p/>').addClass('mb-0 text-left').html(response.question.question)
                            );
                        } */
                        else if(response.question.question_type == 'image' || response.question.question_type == 'gif'){
                            console.log(response.image_list);
                            for(i = 0; i < response.image_list.length; i++){
                                $('#question-text')
                                    .append($('<img/>').attr('src', response.image_list[i]).addClass('img-fluid m-2 input-sharp question-gif')
                                );
                            }

                            $('#question-text')
                                .append($('<p/>').addClass('mb-0 text-left').html(response.question.question)
                            );
                        }

                        $('#answers').empty();
                        $('#revive').empty();
                        for(i = 0; i < response.question.answer.length; i++){
                            $('#answers').append($('<div/>').addClass('col-12 mb-1')
                                .append($('<button/>').addClass('text-left answerbox font-Nunito-Sans font-size-18px d-flex')
                                    .append($('<div/>').addClass('col-2 px-0 align-self-center').html(String.fromCharCode(i+65)+'.')
                                    )
                                    .append($('<div/>').addClass('col-7 p-0 align-self-center').html(response.question.answer[i].answer)
                                    )
                                    .append($('<div/>').addClass('col-3 px-0 answer-percentage align-self-center')
                                    )
                                )
                                .append($('<input/>').attr({'type':'hidden','value': response.question.answer[i].id}))
                            )
                        }

                        $('.answerbox').on('click',function(){  //class adder/remover for answer
                            $('.answerbox').removeClass('answer-select');
                            $(this).addClass('answer-select');
                        })

                        $('#revive-after').hide();    //fade any revive related card back
                        $('#revivecard').hide();
                        $('#questioncard').show();  //restore questioncard back to display
                        $('#overlay-4').fadeIn().css('z-index', '75');
                        if(response.status == 'fail' || response.status == 'disabled') {
                            $('.answerbox').attr('disabled', 'disabled');
                            console.log('user is not allowed to answer anymore');
                            if ({{auth()->user()->life}} > 0 && response.status == 'fail' && response.used_life < 3){
                                $('#revive')
                                    .append($('<span/>').addClass('col-12 font-latobold font-size-18px').html('You are disqualified from continuing. See you again on the next stream!'))
                            }
                            else if ({{auth()->user()->life}} > 0 && response.status == 'fail' && response.used_life >= 3){
                                $('#revive').append($('<span/>').addClass('col-12 font-latobold font-size-18px').html('You have already used 3 lives. Better luck next time!'))
                            }
                            else if (response.status == 'disabled'){
                                $('#revive').append($('<span/>').addClass('col-12 font-latobold font-size-18px').html('Sorry, you are disqualified from the current quiz. Please stay tuned and join us again on the next stream!'))
                            }
                        }
                    }
                }
            });
        }

        $('#uselife-yes').on('click',()=>{
            $.ajax({
                type: "POST",
                url: '{{url("/use-life")}}',
                dataType: 'json',
                data: {
                    'user_id': {{auth()->id()}},
                    'event_id':{{$event->id}},
                },
                success: function(data){
                    $('#revive').empty();
                    $('#revivecard').fadeOut(()=>{
                        $('#used-life').html(data.used_life+'/3')
                        $('#current-used-life').html(data.used_life+'/3')
                        $('#initial-life').html(parseInt($('#current-life').html()) - 1);
                        $('#current-life').html(parseInt($('#current-life').html()) - 1);
                        $('#revive-after').fadeIn(()=>{
                            $('#overlay-4').fadeIn().css('z-index', '75');
                        });
                        clearTimeout(question_timeout);
                        question_timeout = setTimeout(()=>{$('#overlay-4').fadeOut().css('z-index', '0')}, 15000);
                    });
                    $('#life-number').html(data.remaining_life);
                },
            });
        });
        $('#uselife-no').on('click', ()=>{
            $('#life-button').remove();
            $('#questioncard').fadeIn(()=>{
                $('#status-box').fadeIn(()=>{
                    $('#revivecard').fadeOut();
                });
            });
        });

        $('#chat-container').on('swipeleft', ()=>{
            console.log('swiped left');
            $('#chat-container').addClass("swiped-left");
        })

        $('#chatbox').on('click','.jsReply',(e)=>{
            console.log($(e.currentTarget).find('.jsUsername').html());
            $('#reply-text').html('Replying to ').append($('<span/>').attr('id','reply-target').html($(e.currentTarget).find('.jsUsername').html()));
            $('#reply-to').slideToggle('fast');
        })

        $('#disable-chat').on('change', function(){
            $('#chat-col').toggle();
            $('#fade-row').toggleClass('overlay-2-fade');
            $('#menu-col').toggleClass('offset-9');
        })

        $('#disable-sticker').on('change', function(){
            $('#overlay-5').fadeToggle();
        })
    });


    function numFormat(num) {
        var c = (num.toString().indexOf ('.') !== -1) ? num.toLocaleString() : num.toString().replace(/(\d)(?=(?:\d{3})+$)/g, '$1,');
        return c ;
    }
</script>
@endsection
