@extends('layouts.mobile')

@section('prescript')
@endsection

@section('content')

<div class="container-fluid scroller pb-3" style="background-color: #EAEAEA">
    
    <div class="row" style="background-color: white">
        <div class="col-12 text-center text-black font-size-20px font-Montserrat-Bold">
            <div class="py-3"> 
            My Coins: <img src="{{url('images/coin-icon.svg')}}"> {{number_format($user->coins)}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-4 bg-yellow-content">
            <input type="text" class="form-control input-extra-size input-sharp px-4 font-size-20px" placeholder="Search..." id="reward-input">
        </div>
    </div>
    <!--
    <div class="row my-3">
        <div id="button-col" class="col-12 horizontal-scroll redeem-button-bg">
            <button id="all" class='btn font-Montserrat-Bold font-size-18px input-sharp mx-2 h-100 button-reward-selected'>All</button>
            <button id="voucher" class='btn font-Montserrat-Bold font-size-18px input-sharp mx-2 h-100 button-reward-unselected'><img src="{{url('images/redeem-vouchers-icon.svg')}}"><br>Vouchers</button>
            <button id="points" class='btn font-Montserrat-Bold font-size-18px input-sharp mx-2 h-100 button-reward-unselected'><img src="{{url('images/redeem-points-icon.svg')}}"><br>Points</button>
            <button id="deals" class='btn font-Montserrat-Bold font-size-18px input-sharp mx-2 h-100 button-reward-unselected'><img src="{{url('images/redeem-deals-icon.svg')}}"><br>Deals</button>
            <button id="event" class='btn font-Montserrat-Bold font-size-18px input-sharp mx-2 h-100 button-reward-unselected'><img src="{{url('images/redeem-events-icon.svg')}}"><br>Events</button>
        </div>
    </div>
-->
    {{-- <div class="row">
        @foreach($reward as $r)
        <div class="col-12 pb-3">
            <div class="card input-sharp">
                <button class='btn font-Montserrat-Bold font-size-18px reward-type-box' style="background-color: #12FAA5; position:absolute;">{{$r->reward_type}}</button>
                <img class="card-img-top" src="{{$r->img_link}}" style="max-height: 208px; object-fit: cover">
                <div class="card-body pb-1" style="color: black">
                <a href="/reward-details/{{$r->id}}" style="color: black"><h5 class="card-title font-NunitoSans-ExtraBold font-size-18px">{{$r->reward_name}}</h5></a>
                  <p class="card-text font-Nunito-Sans font-size-13px">Entitled to one redeem per account</p>
                  <h6 class="font-latobold font-size-15px text-bold mb-0 pt-2 float-right"><span class="pull-left">{{$r->claim->whereNotNull('user_id')->count()}}/{{$r->claim->count()}}<i class="ml-2 fa fa-archive" aria-hidden="true"></i></span></h6>
                  <p class="font-Montserrat-Bold font-size-15px"><img src="{{url('images/coin-icon.svg')}}">{{$r->cost_in_coins}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div> --}}
    <div id="reward-container" class="container-fluid pb-2">
    @foreach($reward as $r)
        <div class="row bg-white mb-3 redeem-border">
            <div class="col-4 p-0">
                <img src="{{$r->img_link}}" class="img-fluid redeem-img-border redeem-picture"/>
            </div>
            <div class="col-8 font-color-black text-bold font-size-15px p-3
            @switch($r->reward_type) 
                @case('voucher')
                    redeem-bg-voucher
                    @break
                @case('points')
                    redeem-bg-points
                    @break
                @case('deals')
                    redeem-bg-deals
                    @break
                @case('event')
                    redeem-bg-event
                    @break
            @endswitch
            ">
                <a href="/api/viewRedeemPageDetails/{{$user->id}}/{{$r->id}}" style="color: black"><p class="font-NunitoSans-ExtraBold">{{$r->reward_name}}</p></a>
                <h6 class=" font-Montserrat-Bold font-size-15px text-bold pt-1 float-left">{{number_format($r->cost_in_coins)}}<img src="{{url('images/coin-icon.svg')}}"></h6>
                <h6 class="font-latobold font-size-15px text-bold mb-0 pt-2 float-right"><span class="pull-left">{{$r->claim->whereNotNull('user_id')->count()}}/{{$r->claim->count()}}</span></h6>
            </div>
        </div>

        @endforeach
    </div>
</div>
@endsection

@section('postscript')
<script>
    $(".nav_redeem").addClass("active");
    $(".footer-word-redeem").addClass("active");

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#button-col button').on('click',function(){
            $('#button-col button.button-reward-selected').removeClass('button-reward-selected').addClass('button-reward-unselected');
            $(this).addClass('button-reward-selected').removeClass('button-reward-unselected');

            $.ajax({
                url: "{{ url('/api/reward-filter-button') }}",
                method: 'post',
                data: {
                    "reward_type" : $(this).attr('id'),
                },
                success: function (response) {
                    $('#reward-container').fadeOut(()=>{
                        $('#reward-container').empty();
                        for (i = 0; i < response.reward.length; i++){
                        $('#reward-container')
                            .append($('<div/>').addClass('row bg-white mb-3 redeem-border')
                                .append($('<div/>').addClass('col-4 p-0')
                                    .append($('<img/>').addClass('img-fluid redeem-img-border redeem-picture').attr('src',response.reward[i].img_link)
                                    )
                                )
                                .append($('<div/>').addClass('col-8 font-color-black text-bold font-size-15px p-3 redeem-bg-'+response.reward[i].reward_type)
                                    .append($('<a>').attr({
                                            'href': '/api/viewRedeemPageDetails/'+{{$user->id}}+'/'+response.reward[i].id,
                                            'style': 'color: black;',
                                        })
                                        .append($('<p/>').addClass('font-NunitoSans-ExtraBold').html(response.reward[i].reward_name)
                                        )
                                    )
                                    .append($('<h6/>').addClass('font-Montserrat-Bold font-size-15px text-bold pt-1 float-left').html(response.reward[i].cost_in_coins.toLocaleString()   )
                                        .append($('<img>').attr('src','{{url("images/coin-icon.svg")}}')
                                        )
                                    )
                                    .append($('<h6/>').addClass('font-latobold font-size-15px text-bold mb-0 pt-2 float-right')
                                        .append($('<span/>').addClass('pull-left').html(response.reward[i].claim.filter(function(data2){return data2.user_id == 101;}).length+'/'+response.reward[i].claim.length)
                                        )
                                    )

                                )
                            )
                        }
                    });
                    $('#reward-container').fadeIn();
                }
            });
        });

        var timeout_name = null;
        $('#reward-input').on('keyup', function(){
            clearTimeout(timeout_name);
            timeout_name = setTimeout(function(){
                $.ajax({
                    url: "{{ url('/api/reward-filter-input') }}",
                    method: 'post',
                    data: {
                        'reward_name' : $('#reward-input').val(),
                    },
                    success: function (response) {
                        if (response.status = 'available'){
                            $('#reward-container').fadeOut(()=>{
                                $('#reward-container').empty();
                                for (i = 0; i < response.reward.length; i++){
                                $('#reward-container')
                                    .append($('<div/>').addClass('row bg-white mb-3 redeem-border')
                                        .append($('<div/>').addClass('col-4 p-0')
                                            .append($('<img/>').addClass('img-fluid redeem-img-border redeem-picture').attr('src',response.reward[i].img_link)
                                            )
                                        )
                                        .append($('<div/>').addClass('col-8 font-color-black text-bold font-size-15px p-3 redeem-bg-'+response.reward[i].reward_type)
                                            .append($('<a>').attr({
                                                    'href': '/api/viewRedeemPageDetails/'+{{$user->id}}+'/'+response.reward[i].id,
                                                    'style': 'color: black;',
                                                })
                                                .append($('<p/>').addClass('font-NunitoSans-ExtraBold').html(response.reward[i].reward_name)
                                                )
                                            )
                                            .append($('<h6/>').addClass('font-Montserrat-Bold font-size-15px text-bold pt-1 float-left').html(response.reward[i].cost_in_coins.toLocaleString()   )
                                                .append($('<img>').attr('src','{{url("images/coin-icon.svg")}}')
                                                )
                                            )
                                            .append($('<h6/>').addClass('font-latobold font-size-15px text-bold mb-0 pt-2 float-right')
                                                .append($('<span/>').addClass('pull-left').html(response.reward[i].claim.filter(function(data2){return data2.user_id == 101;}).length+'/'+response.reward[i].claim.length)
                                                )
                                            )

                                        )
                                    )
                                }
                            });
                            $('#reward-container').fadeIn();
                        }
                    }
                });
            }, 500)
        });
    });
</script>
@endsection
