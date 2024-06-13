@extends('layouts.app')

@section('prescript')
@endsection

@section('content')
<div class="container-fluid bg-red scroller">
    <div class="row">
        <div class="col-12 pt-3">
            <p class="font-markerfelt text-white font-size-25px">Quiz Control Panel</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 pt-3">
            <p class="font-markerfelt text-white font-size-18px">Event: #{{$event->id}} {{$event->event_name}}</p>
        </div>
    </div>
    <div class="row pb-3">
        <div class="col-12">
            <div class="scoreboard-container pb-3">
                <table class="table">
                    <thead class='font-markerfelt'>
                        <tr class="table-border-bottom d-flex font-size-28px text-center">
                            <th class="col-3">Fired?</th>
                            <th class="col-6">Question</th>
                            <th class="col-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class='font-markerfelt' id="quiz-button">
                        @foreach ($event->question as $q)
                        <tr class="table-border-bottom d-flex text-center">
                            <td class="col-3 font-size-20px fired-panel">{{$q->fired}}</td>
                            <td class="col-6 font-size-20px question-panel">{{$q->question}}</td>
                            <td class="col-3">
                                <button class="mb-2 send-panel btn @if ($q->fired == 'false') button-yellow-small @else button-gray-nostock @endif font-komikaaxis font-size-13px text-black" data-toggle="modal" data-target="#redeem-modal" @if ($q->fired == 'true') disabled @endif>Ques</button>
                                <button class="mt-2 result-panel btn @if ($q->fired == 'true') button-yellow-small @else button-gray-nostock @endif font-komikaaxis font-size-13px text-black" data-toggle="modal" data-target="#redeem-modal" @if ($q->fired == 'false') disabled @endif>Result</button>
                                <input type="hidden" value="{{$q->id}}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="offset-3 col-6">
                    <button id="scoreboard-button" class="btn @if ($event->question->pluck('fired')->contains('false')) button-gray-nostock @else button-yellow-redeem @endif font-komikaaxis font-size-13px text-white">SCOREBOARD</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <button id="reset" class="btn button-yellow-redeem font-komikaaxis font-size-13px text-white">
                Reset (test purpose)
            </button>
        </div>
    </div>
</div>
@endsection

@section('postscript')
    <script>


        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /* function loadTable(data){
                $.ajax({
                    type: "POST",
                    url: '{{url("/get-eventdata")}}',
                    dataType: 'json',
                    data: {
                        'event_id': data.val(),
                    },
                    success: function(data){
                        $('#scoreboard-button').parent().remove();
                        $('#quiz-button').empty();
                        for (i = 0; i < data[0].question.length; i++){
                            var button;
                            if (data[0].question[i].fired == 'false') button = 'button-yellow-redeem';
                            else button = 'button-gray-nostock';
                            $('#quiz-button').append($('<tr/>').addClass("table-border-bottom d-flex text-center")
                                .append($('<td/>').addClass('col-3 font-size-20px').html(data[0].question[i].fired))
                                .append($('<td/>').addClass('col-6 font-size-20px').html(data[0].question[i].question))
                                .append($('<td/>').addClass('col-3')
                                    .append($('<button/>').addClass('btn '+button+' font-komikaaxis font-size-13px text-white').attr({"id":"question-"+data[0].id+"-"+i}).html('SEND'))
                                    .append($('<input/>').attr({'type':'hidden'}).val(data[0].question[i].id)))
                                )
                        }
                        $('.scoreboard-container').append($('<div/>').addClass('offset-3 col-6')
                            .append($('<button/>').addClass('btn button-yellow-redeem font-komikaaxis font-size-13px text-white').attr({'id': 'scoreboard-button'}).html('SCOREBOARD'))
                        )

                        for (j = 0; j < data[0].question.length; j++){
                            console.log(data[0].question[j].fired);
                            if (data[0].question[j].fired == 'false') $('#scoreboard-button').removeClass('button-yellow-redeem').addClass('button-gray-nostock').attr('disabled','disabled');
                        }

                    },
                    error: function(){
                        console.log('failed');
                    },
                });
            } */
            

            let ip_address = "{{env('SOCKETIO_ADDRESS')}}";
            var socket = io.connect(ip_address);

            socket.on("connect", function(){
                socket.emit("admin-quiz-panel");
            });

            var event = {{$event->id}};

            /* $('#event-selector').on('change',function(){
                event = $(this).val();
                loadTable($(this));
            }); */

            $('#quiz-button').on('click','.send-panel',function(){
                    var current = $(this);
                    console.log(current.parent().siblings('.fired-panel').html());
                    $.ajax({
                        type: "POST",
                        url: '{{url("/fire-question")}}',
                        dataType: 'json',
                        data: {
                            'question_id': $(this).siblings('input').val(),
                            'event_id': event,
                        },
                        success: function(){
                            current.parent().siblings('.fired-panel').html('true');
                            current.removeClass('button-yellow-small').addClass('button-gray-nostock').attr('disabled', true);
                            current.siblings('.result-panel').removeClass('button-gray-nostock').addClass('button-yellow-small').removeAttr('disabled');
                            socket.emit('quiz-send', event);
                        }
                    });
            });
            $('#quiz-button').on('click','.result-panel',function(){
                    console.log('result');
                    socket.emit('result-send', event, $(this).siblings('input').val());
            });

            $('.scoreboard-container').on('click','#scoreboard-button',function(){
                    console.log('scoreboard button');
                    $.ajax({
                        type: "POST",
                        url: '{{url("/fire-scoreboard")}}',
                        dataType: 'json',
                        data: {
                            'event_id': event,
                        },
                        success: (response)=>{
                            console.log(response.prize_money);
                            socket.emit('fire-scoreboard', event, response.user_id, response.prize_money)
                        }
                    })
            });

            $('#reset').on('click',()=>{
                $.ajax({
                    type: "POST",
                    url: '{{url("/reset-panel")}}',
                    dataType: 'json',
                    success: function(){
                        console.log('resetting button state');
                        $('#quiz-button').find('.fired-panel').html('false');
                        $('#quiz-button').find('.send-panel').removeClass('button-gray-nostock').addClass('button-yellow-small').attr('disabled', false);
                        $('#quiz-button').find('.result-panel').removeClass('button-yellow-small').addClass('button-gray-nostock').removeAttr('disabled');
                    }
                })
            })
        });
    </script>
@endsection

