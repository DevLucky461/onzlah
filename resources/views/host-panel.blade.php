@extends('layouts.app')

@section('prescript')
    <style>
        .border-2px{
            border: 2px solid #000;
        }
        .bg-leaf{
            background-color: #00ff01;
        }

        .border-radius-7px{
            border-radius: 7px; 
        }

        .bg-old-blue{
            background-color: #00ffff;
        }

        textarea::placeholder{
            color: #000;
           
            padding: 10px;
        }

        textarea{
            color: #000;
           
            padding: 10px;
        }

        .bg-light{
            background-color:#eeeeee
        }
        
        .bg-yllw{
            background-color: #ffff00;
        }

        table{
            border-collapse: separate;
            border-spacing: 0px 22px;
        }

        .table th, .table td{
            border-top: 2px solid #000;
        }
    
    </style>
@endsection

@section('content')
<div class="container p-5">
    <div class="row" style="height: 100vh">
        <div class="col-12">
            <div class="container-fluid font-color-black">
                <div class="row py-3">
                    <div class="col-3">
                        <div class="mb-0 border-2px bg-leaf border-radius-7px w-100 font-size-18px pr-0" style="padding: 0.5rem 1rem;">
                            <span >Live View Counter: </span><span id="counter">0</span>
                        </div>
                    </div>
                    <div class="col-2 text-center content-align-center">
                        <div id="indicator" style="display: none"><i class="fa fa-exclamation-circle fa-2x fa-fw" aria-hidden="true"></i><i class="fa fa-picture-o fa-2x fa-fw" aria-hidden="true"></i></div>
                    </div>
                    <div class="col-2">
                        <button id="timerbox" class="btn btn-lg btn-success border-2px font-size-30px py-0 font-Montserrat-ExtraBold" style="width: 150px">45</button>
                    </div>
                    <div class="col-1">
                        <button id="reset" class="btn btn-lg btn-danger border-2px">Reset</button>
                    </div>
                    <div class="col-1">
                        <button id="scoreboard-button" class="btn btn-lg btn-danger border-2px">Winnercard</button>
                    </div>
                    <div class="col-3 text-right">
                         <button id="prev" class="btn btn-lg btn-primary border-2px" disabled > Prev </button>
                         <button id="next" class="btn btn-lg btn-primary border-2px" > Next </button>
                    </div>
                </div>

                <input id="q-id" type="hidden" value="{{$question->id}}">
                <div class="row">

                    <div class="col-6">
                        <div class="border-2px bg-light p-2">

                            <div class="row" >
                                <div class="col-8 d-flex">
                                    #<span id="question-number" class="col-2">1</span><span id="question" class="col-10 font-size-18px">{{$question->question}}</span>
                                </div>
                                <div class="col-4 text-right">
                                    <button id="fire-question" class="btn btn-lg border-2px">Fire</button>
                                </div>
                            </div>

                        </div>
                        
                        <table class="table  mb-0 font-color-black font-size-18px">
                            <tbody id="answers">
                                @foreach($question->answer as $a)
                                <tr>
                                    <td class="border-2px @if($a->status == 'correct') bg-lime @endif">{{$a->answer}} <span class="pull-right"></span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="border-2px bg-light p-2">
                            <div class="row" >
                                <div class="col-8">
                                    <span id="question" class="font-size-18px">Answer Fire</span>
                                </div>
                                <div class="col-4 text-right">
                                    <button id="fire-result" class="btn btn-lg border-2px">Fire</button>
                                </div>
                            </div>
                        </div>

                        <div id="chatbox" class="border-2px bg-yllw p-2 mt-3 host-chat-desc">
                        @foreach($message as $m)
                            <div class="col-12 mt-2 text-left chat-text-lineheight font-size-16px font-Montserrat">{{$m->users->name}} : {{$m->message}}</div>
                        @endforeach 
                        </div>

                    </div>


                    <div class="col-6"> 
                        <textarea class="w-100 h-100 border-2px bg-old-blue font-size-18px" name="emcee_pointer" cols="30" rows="10" placeholder="Emcee Pointer"></textarea>
                    </div>
                </div>  
        </div>
    </div>
</div>

    

@endsection

@section('postscript')
<script>



    $(document).ready(function(){
        $('#chatbox').scrollTop(document.getElementById('chatbox').scrollHeight);

        let ip_address = "{{env('SOCKETIO_ADDRESS')}}";
        var socket = io.connect(ip_address);

        socket.on("connect", function(){
            socket.emit("admin-quiz-panel", {{$event->id}});
        });
        socket.on("messages", function(message){
            console.log('hehe');
            $('#chatbox').append($('<div/>').addClass('col-12 mt-2 text-left chat-text-lineheight font-size-16px font-Montserrat').html( message.sender_name + ' : ' + wordFilter(message.message)));
            $('#chatbox').scrollTop(document.getElementById('chatbox').scrollHeight);

        })
        socket.on('receivecount', (count)=>{
            console.log('hehehehehehe');
            $('#counter').html(count);
        });
        //--- wordfilter section ---//
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
        //--- end wordfilter section ---//
        $('.footer-pos').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var index = 0

        $('#next').on('click',()=>{
            index += 1;
            if(index != 0) $('#prev').removeAttr('disabled');
            if(index == 7) $('#next').attr('disabled','disabled');
            getQuestion();
        })

        $('#prev').on('click',()=>{
            index -= 1;
            if(index != 7) $('#next').removeAttr('disabled');
            if(index == 0) $('#prev').attr('disabled','disabled');
            getQuestion();
        })
        getPercent();
        setInterval(getPercent,2000);

        
        $('#reset').on('click',()=>{
            $.ajax({
                type: "POST",
                url: '{{url("/reset-panel")}}',
                dataType: 'json',
                success: function(){
                }
            })
        });

        $('#scoreboard-button').on('click',function(){
            $.ajax({
                type: "POST",
                url: '{{url("/fire-scoreboard")}}',
                dataType: 'json',
                data: {
                    'event_id': '{{$event->id}}',
                },
                success: (response)=>{
                    console.log(response.prize_money);
                    socket.emit('fire-scoreboard', {{$event->id}}, response.user_id, response.prize_money)
                }
            })
        });

        //--- fire trigger section ---//

        $('#fire-question').on('click',()=>{fireQuestion()});
        $('#fire-result').on('click',()=>{fireResult()});

        //--- end fire trigger section ---//

        //--- var section ---//
        var timer;
        //--- end var section ---//
        //--- function section ---//

        function getPercent(){
            $.ajax({
                url: "{{ url('/get-score-percentage') }}",
                method: 'post',
                data: {
                    "question_id" : $('#q-id').val(),
                },
                success: function (response) {
                    $('#answers').find('span').each(function(n){
                        $(this).html(response.percentage[n]);
                    });
                }
            });
        }

        function getQuestion(){
            $('#answers').find('td').each(function(index){
                $(this).append($('<span/>').addClass('pull-right'));
            })
            $.ajax({
                url: "{{ url('/get-question') }}",
                method: 'post',
                data: {
                    "index" : index,
                    "event_id" : {{$event->id}},
                },
                success: function (response) {
                    console.log(response);
                    $('#indicator').fadeOut();
                    if(response.question.question_type == 'gif' || response.question.question_type == 'image'){
                        $('#indicator').fadeIn();
                    }
                    $('#question').html(response.question.question);
                    $('td').removeClass('bg-lime');
                    $('#answers').find('td').each(function(i){
                        console.log(response.question.answer[i] == null);
                        if(response.question.answer[i] != null){
                            $(this).html(response.question.answer[i].answer);
                            $(this).append($('<span/>').addClass('pull-right'));
                            $('#question-number').html(index+1);
                            if (response.question.answer[i].status == 'correct') {
                                $(this).addClass('bg-lime');
                            }
                        }
                        else $(this).empty();
                    })
                    $('#q-id').val(response.question.id);
                    getPercent();
                }
            });
            $('#timerbox').removeClass('btn-danger').addClass('btn-success').html('45');
            clearInterval(timer);
        }

        function fireQuestion(){
            console.log('question fired');
            $.ajax({
                type: "POST",
                url: '{{url("/fire-question")}}',
                dataType: 'json',
                data: {
                    'question_id': $('#q-id').val(),
                    'event_id': {{$event->id}},
                },
                success: function(){
                    socket.emit('quiz-send', {{$event->id}});
                }
            });
            if ($('#timerbox').html() == '45'){
                timer = setInterval(function(){
                    console.log('hehe');
                    $('#timerbox').html($('#timerbox').html() - 1);
                    if ($('#timerbox').html() == '30'){
                        $('#timerbox').removeClass('btn-success').addClass('btn-danger');
                    }
                    if ($('#timerbox').html() == '0'){
                        clearInterval(timer);
                    }
                },1000);
            }
        }

        function fireResult(){
            console.log('result fired');
            socket.emit('result-send', {{$event->id}}, $('#q-id').val());
        }

        function fireScoreboard(){
            $.ajax({
                type: "POST",
                url: '{{url("/fire-scoreboard")}}',
                dataType: 'json',
                data: {
                    'event_id': {{$event->id}},
                },
                success: (response)=>{
                    console.log(response.prize_money);
                    socket.emit('fire-scoreboard', {{$event->id}}, response.user_id, response.prize_money)
                }
            })
        }
    });
</script>
@endsection
