@extends('layouts.app')

@section('prescript')
@endsection

@section('content')
<div id="redeem-contaner" class="scroller container-fluid text-white bg-red">
    <div class="row">
        <div class="col-12 p-0 redeem-header-bg">
            <img src="{{url('images/redeem-header-text.svg')}}" class="img-fluid banner-header-full p-20"/>
        </div>
    </div>
    <div class="pt-4"></div>
    <div class="row text-center">
        <div class="col-6 pr-1">
            <a href="/coins"><button type="button" class="btn button-color-white button-border-custom font-markerfeltwide font-size-18px"><img src="{{url('images/coin-icon.svg')}}"> {{auth()->user()->coins}} Coins</button></a>
        </div>
        <div class="col-6 pl-1">
            <a href="/voucher/{{auth()->id()}}"><button id="button-voucher" type="button" class="btn button-color-white button-border-custom font-markerfeltwide font-size-18px"><span id='reward-count'>{{$currentclaim->count()}}</span> Claimed Rewards</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <p class="text-white font-markerfelt font-size-22px pt-3">Available Vouchers</p>
        </div>
    </div>

    <div class="container-fluid pb-2">
        @foreach($reward as $r)
        <div class="row bg-white mb-3">
            <div class="col-4 p-0">
                <img src="{{$r->img_link}}" class="img-fluid menu-img redeem-picture"/>
            </div>
            <div class="col-5 font-color-black font-markerfelt text-bold font-size-16px pr-0 pl-2">
                <div id="reward-{{$loop->index}}-id" style="display: none;">{{$r->id}}</div>
                <img src="{{$r->sponsor_icon_link}}" />
                <p id="reward-{{$loop->index}}-name" class="pr-2">{{$r->reward_name}}</p>
            </div>
            <div class="col-3 font-color-black pl-0">
                <button id="reward-{{$loop->index}}" class="btn @if($r->claim->pluck('user_id')->contains(null)) button-yellow-redeem @else button-gray-nostock @endif font-komikaaxis font-size-13px text-white mt-4" data-toggle="modal" data-target="#redeem-modal" @if(!($r->claim->pluck('user_id')->contains(null))) disabled @endif>@if($r->claim->pluck('user_id')->contains(null)) Redeem @else Out of stock @endif</button>
                <h6 class="font-latobold font-size-15px text-bold mb-0 pt-2 float-right"><span class="pull-left">{{$r->claim->whereNotNull('user_id')->count()}}/{{$r->claim->count()}}<i class="ml-2 fa fa-archive" aria-hidden="true"></i></span></h6>
                <h6 class="font-latobold font-size-15px text-bold pt-1 float-right"><span id="reward-{{$loop->index}}-price">{{$r->cost_in_coins}}</span><img src="{{url('images/coin-icon.svg')}}"></h6>
            </div>
        </div>

        @endforeach
    </div>

    <div class="modal fade" id="redeem-modal">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content modal-border mx-4">
                <div class="modal-body font-color-black text-center">
                    <p id="modal-header" class="font-markerfelt font-size-22px"></p>
                    <p id="modal-body" class="font-latobold font-size-18px"></p>
                    <button id="confirm-button" type="button" class="btn button-yes font-komikaaxis font-size-13px text-white my-3 mr-2 py-2" data-dismiss="modal" data-toggle="modal" data-target="#confirmation-modal">Yes</button>
                    <button type="button" class="btn button-no font-komikaaxis font-size-13px text-white my-3 ml-2 py-2" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmation-modal">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content modal-border mx-4">
                <div class="modal-body font-color-black text-center">
                    <p id="modal-header-confirm" class="font-markerfelt font-size-22px"></p>
                    <p id="modal-body-confirm" class="font-latobold font-size-18px">has been redeemed.</p>
                </div>
            </div>
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
            var reward_id = "";

            $('.button-yellow-redeem').on('click', function(){
                console.log(parseInt($('#reward-count').html())+1);
                reward_id = $('#'+$(this).attr('id')+'-id').html();
                button_id = $(this).attr('id');
                $('#modal-header').html($('#'+$(this).attr('id')+'-name').html());
                $('#modal-body').html('Are you sure to redeem this voucher for '+$('#'+$(this).attr('id')+'-price').html()+' coins?');
            })

            $('#confirm-button').on('click', function(){
                $('#modal-header-confirm').html($('#modal-header').html());
                $.ajax({
                    type: "POST",
                    url: '{{url("/redeem-add")}}',
                    dataType: 'json',
                    data: {
                        'reward_id': reward_id,
                        'user_id': {{auth()->id()}},
                    },

                    success: function(data){
                        if (data.success == 'true'){
                            $('#modal-header-confirm').html($('#modal-header').html());
                            $('#reward-count').html(parseInt($('#reward-count').html()) + 1);
                        }
                        else {
                            $('#modal-header-confirm').html(data.message);
                            $('#modal-body-confirm').html('');
                        }
                    },
                    error: function(data){
                        $('#modal-body-confirm').html('Sorry, an error is encountered when processing your request. Please refresh the page and try again.');
                    },
                });
            })
        });
    </script>
@endsection
