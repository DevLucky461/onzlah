@extends('layouts.app')

@section('prescript')
@endsection

@section('content')

<div class="container-fluid scroller pb-3" style="background-color: #EAEAEA">
    <div class="row pt-5 purple-header redeem-bg-header bg-violet text-white" style="background-color:green">
        <div class="col-4">
            <a href="/"><img src="{{url('images/onzlah-logo-small.png')}}" alt=""></a> 
        </div>
        <div class="col-3">
            <div class="header-menu font-Montserrat font-size-20px FFEF41-color">
               <a class="FFEF41-color text-deco-none redeem-list" href="/redeem">LIST</a>
            </div>
        </div>
        <div class="col-5">
            <div class="header-menu font-Montserrat font-size-20px FFEF41-color">
                <a class="FFEF41-color text-deco-none redeem-myredeems redeem-tabs-bb" href="/voucher/{{auth()->user()->id}}" class="text-underline">MY REDEEMS</a>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-3">
    @foreach($reward as $r)
        @foreach($r->claim->where('user_id', $id) as $i)
            <a href="/redeem-details/{{$r->id}}/{{$i->id}}" style="color: black">
                <div class="row bg-white mb-3 redeem-border @if ($i->status != 'valid') grayscale @endif">
                    <div class="col-4 p-0">
                        <div style="background-image:url({{$r->img_link}})" class="img-fluid redeem-img-border redeem-picture"></div>
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
                        <div id="reward-{{$loop->index}}-id" style="display: none;">{{$r->id}}</div>
                        <p id="reward-{{$loop->index}}-name" class="font-NunitoSans-ExtraBold">{{$r->reward_name}}</p>
                        <h6 class="font-Montserrat font-size-13px pt-1 float-left mt-3">Expires on {{Carbon\Carbon::parse($r->expiration_date)->format('d M Y')}}</h6>
                        <span class="badge badge-danger pull-right mt-3" @if ($i->status == 'valid') style="display:none" @endif> @if($i->status == 'expired') Expired @elseif ($i->status == 'used') Used @endif</span>
                    </div>
                </div> 
            </a>
        @endforeach
    @endforeach
    </div>
</div>
@endsection

@section('postscript')
<script>
    $(".nav_redeem").addClass("active");
    $(".footer-word-redeem").addClass("active");
</script>
@endsection
