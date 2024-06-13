@extends('layouts.app')

@section('prescript')
@endsection

@section('content')

<div class="container-fluid bg-red scroller px-3">
    <div class="row">
        <div class="col-12 header-blue back-padding">
            <a href='{{url()->previous()}}'><i class="las la-angle-left la-2x text-white"></i><span class="font-markerfelt font-size-22px text-white">Back</span></a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 pt-3">
            <p class="font-markerfelt text-white font-size-25px">Your Vouchers</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @foreach($reward as $r)
            @foreach($r->claim->filter(function($r){return $r->user_id == auth()->id();}) as $c)
            <div class="container-fluid bg-white font-color-black pb-4 mb-4">
                <div class="row my-3">
                    <div class="col-12 p-0">
                    <img src="{{$r->img_link}}" alt="" class="voucher-img">
                    </div>
                </div>
                <div class="row pt-4 px-3">
                    <div class="col-8">
                        <p class="font-color-black font-markerfelt text-bold font-size-22px">{{$r->reward_name}}<p>
                        <p class="font-latoregular font-size-12px">Expires on <span class="font-latobold">{{Carbon\Carbon::parse($r->expiration_date)->format('d M Y')}}</span></p>
                    </div>
                    <div class="col-4">
                        <img src="{{url('img/locationpointer.png')}}" class="voucher-icon p-3">
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="code" class="font-latoregular font-size-15px">Voucher Code</label>
                        <input type="text" class="form-control font-size-18px font-latobold rounded" id="code" disabled value="{{$c->reward_code}}">
                        </div>
                    </div>
                    <div class="col-4 pb-3">
                        <button id="voucher-1" class="btn button-yellow-redeem font-komikaaxis font-size-13px text-white mt-4">Copy</button>
                    </div>
                    <div class="col-8 font-latobold font-size-15px">
                        <p class='mb-0'>Redeem your voucher code at</p><p> meh</p>
                    </div>
                </div>
                <div class="row mx-3 mb-2 voucher-howto px-3">
                    <div class="col-10 py-3">
                        <span class='font-latobold font-size-15px'>How to Redeem</span>
                    </div>
                    <div class="col-2"><i class="fa fa-angle-down fa-2x pull-right py-3" aria-hidden="true"></i></div>
                </div>
                <div class="row mx-3 mb-2 voucher-howto px-3">
                    <div class="col-10 py-3">
                        <span class='font-latobold font-size-15px'>Terms & Condition</span>
                    </div>
                    <div class="col-2"><i class="fa fa-angle-down fa-2x pull-right py-3" aria-hidden="true"></i></div>
                </div>
            </div>
            @endforeach
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('postscript')
<script>
 $(document).ready(function(){
        $('#btn-friend').on('click', function(){
            $(this).removeClass('button-scoreboard-inactive').addClass('button-scoreboard-active');
            $('#btn-all').removeClass('button-scoreboard-active').addClass('button-scoreboard-inactive');
            $('#friendscore').toggle();
            $('#allscore').toggle();
        })

        $('#btn-all').on('click', function(){
            $(this).removeClass('button-scoreboard-inactive').addClass('button-scoreboard-active');
            $('#btn-friend').removeClass('button-scoreboard-active').addClass('button-scoreboard-inactive');
            $('#friendscore').toggle();
            $('#allscore').toggle();
        })
 })
</script>
@endsection
