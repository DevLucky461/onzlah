@extends('layouts.mobile')

@section('prescript')
<style>
    .scroller{
        height: 100% !important;
    }
</style>
@endsection

@section('content')

<div class="container-fluid scroller pb-3" style="background-color: #EAEAEA">
    <div class="container-fluid pt-3">
    @foreach($reward as $r)
        @foreach($r->claim->where('user_id', $id) as $i)
        <div class="row bg-white mb-3 redeem-border @if ($i->status != 'valid') grayscale @endif">
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
                <div id="reward-{{$loop->index}}-id" style="display: none;">{{$r->id}}</div>
                <a href="/api/myredeem-details/{{$r->id}}/{{$i->id}}" style="color: black"><p id="reward-{{$loop->index}}-name" class="font-NunitoSans-ExtraBold">{{$r->reward_name}}</p></a>
                <h6 class="font-Montserrat font-size-13px pt-1 float-left mt-3">Expires on {{Carbon\Carbon::parse($r->expiration_date)->format('d M Y')}}</h6>
                <span class="badge badge-danger pull-right mt-3" @if ($i->status == 'valid') style="display:none" @endif> @if($i->status == 'expired') Expired @elseif ($i->status == 'used') Used @endif</span>
            </div>
        </div> 
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