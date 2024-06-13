@extends('layouts.app')

@section('prescript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection

@section('content')

<div class="container-fluid scroller pb-3" style="color: black;">
    <div class="row pt-5 h-122px main-header-bg text-white">
        <div class="col-4">
            <a href='{{url()->previous()}}'><i class="las la-angle-left la-3x text-white"></i></a>
        </div>
        <div class="col-1 text-center">
            <div class="header-menu-details font-Montserrat font-size-28px FFEF41-color pb-3" style="left: 40%;">
                DETAILS
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-0 details-image" style="background-image: url('{{$r->img_link}}');">
        <div class='m-3 btn font-Montserrat-Bold font-size-18px input-sharp redeem-bg-{{$r->reward_type}}'>{{Str::ucfirst($r->reward_type)}}</div>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-12">
            <p class="font-Montserrat-Bold font-size-24px">{{$r->reward_name}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p class="details-avail-box font-NunitoSans-ExtraBold font-size-20px text-center bg-violet text-white">{{$r->claim->whereNotNull('user_id')->count()}}/{{$r->claim->count()}}</p>
        </div>
        <div class="col-8">
            <p class="font-Montserrat-Bold font-size-22px pull-right"><img src="{{url('images/coin-icon.svg')}}">{{$r->cost_in_coins}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 font-NunitoSans-Regular">
            <p class="font-size-14px">
                <span class="font-NunitoSans-ExtraBold">Expires on : </span>{{Carbon\Carbon::parse($r->expiration_date)->format('d M Y')}}
            </p>
            <p class="font-size-16px">{{$r->reward_description}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-2 mt-4">
            <div class="details-drop p-4">
                <p class="font-Montserrat-ExtraBold font-size-20px">
                    <span class="pull-left">How to Redeem</span>
                    <span class="pull-right"> 
                        <i id="how-to" class="fa fa-plus fa-lg" aria-hidden="true"></i>
                        <img id="how-to-after" src="{{url('/images/redeem-tab-after.svg')}}" width="25" height="25">
                    </span>
                </p>
                <p id="how-to-desc" class="font-Nunito-Sans font-size-16px pt-4 text-left details-desc" style="display:none;"></p>
            </div>
        </div>
        <div class="col-12 mb-2 mt-1">
            <div class="details-drop p-4">
                <p class="font-Montserrat-ExtraBold font-size-20px">
                    <span class="pull-left">Terms and Condition</span>
                    <span class="pull-right"> 
                        <i id="tnc" class="fa fa-plus fa-lg" aria-hidden="true"></i>
                    </span>
                </p>
                <p id="tnc-desc" class="font-Nunito-Sans font-size-16px pt-4 text-left details-desc" style="display:none;"></p>
            </div>
        </div>
        <div class="col-12 mt-4 mb-5">
            <button id="redeem" class="btn details-redeem font-Montserrat-ExtraBold font-size-30px p-2">REDEEM NOW</button>
        </div>
    </div>
</div>


<div class="modal fade scroller" id="redeem-modal">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content mx-4">
            <div class="modal-body redeem-prompt font-color-black text-center py-5">
            <p id="modal-body" class="font-NunitoSans-ExtraBold font-size-20px">Are you sure you want to spend <img src="{{url('/images/coin-icon.svg')}}">{{$r->cost_in_coins}} to redeem this voucher?</p>
            
            <button id='confirm-button' class="btn details-avail-box font-size-13px text-black border-radius-0px h-65px w-65px m-8px" data-dismiss="modal" style="background-color: #00FE45">
            <img src="{{url('/images/reward/tick.png')}}" alt="">
            </button>
            
            <button id='decline-button' class="btn details-avail-box font-size-13px text-black bg-white border-radius-0px h-65px w-65px m-8px" data-dismiss="modal">
                <img src="{{url('/images/reward/cross.png')}}" alt="">
            </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade scroller" id="confirmation-modal">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content mx-4">
            <div class="modal-body redeem-success font-color-black text-center">
            <p id="modal-body" class="font-NunitoSans-ExtraBold font-size-20px">{{$r->reward_name}} has been successfully redeemed!</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade scroller" id="error-modal">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content mx-4">
            <div class="modal-body redeem-success font-color-black text-center">
            <p id="modal-body" class="font-NunitoSans-ExtraBold font-size-20px">Sorry, your transaction could not be completed. Please check whether you have sufficient balance to purchase this.</p>
            </div>
        </div>
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

        $('#how-to-after').hide();

        $('#how-to').on('click', ()=>{
            $('#how-to-desc').empty().slideToggle(()=>{
                $('#how-to-desc').html('{{$r->reward_howto}}');
            });
            $('#how-to').hide();
            $('#how-to-after').fadeIn();
        })

        $('#how-to-after').on('click', ()=>{
            $('#how-to-desc').empty().slideToggle(()=>{
                $('#how-to-desc').html('{{$r->reward_howto}}');
            });
            $('#how-to-after').hide();
            $('#how-to').fadeIn();
        })

        $('#tnc').on('click', ()=>{
            $('#tnc-desc').empty().slideToggle(()=>{
                $('#tnc-desc').html('{{$r->reward_tnc}}');
            });
        })

        $('#redeem').on('click',()=>{
            $('#redeem-modal').modal('show');
        })

        $('#confirm-button').on('click',()=>{
            $.ajax({
                type: "POST",
                url: '{{url("/redeem-add")}}',
                dataType: 'json',
                data: {
                    'reward_id': {{$r->id}},
                    'user_id': {{auth()->id()}},
                },
                success: function(response){
                    if (response.success == 'true') $('#confirmation-modal').modal('show');
                    else if (response.success == 'false') $('#error-modal').modal('show');
                },
            });
        })
    })
</script>
@endsection
