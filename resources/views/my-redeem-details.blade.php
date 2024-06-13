@extends('layouts.app')

@section('prescript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection

@section('content')

<div class="container-fluid scroller pb-3" style="color: black;">
    <div class="row pt-5 purple-header bg-violet text-white">
        <div class="col-4">
            <a href='{{url()->previous()}}'><i class="las la-angle-left la-3x text-white"></i></a>
        </div>
        <div class="col-1 text-center">
            <div class="header-menu-details font-Montserrat font-size-28px FFEF41-color pb-3" style="left: 40%;">
                REDEEM
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-0 details-image" style="background-image: url('{{$r->img_link}}');">
            <button class='m-3 btn font-Montserrat-Bold font-size-18px input-sharp' style="background-color: #12FAA5">Vouchers</button>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-12">
            <p class="font-Montserrat-Bold font-size-24px">{{$r->reward_name}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-8 pt-2">
            <p class="font-size-14px">
                <span class="font-NunitoSans-ExtraBold">Expires on : </span>{{Carbon\Carbon::parse($r->expiration_date)->format('d M Y')}}
            </p></div>
        <div class="col-4">
            <p class="font-Montserrat-Bold font-size-22px pull-right"><img src="{{url('images/coin-icon.svg')}}">{{$r->cost_in_coins}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 font-NunitoSans-Regular">
            <p class="font-size-16px">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
        </div>
    </div>
    <div class="row">
        <div id="code" class="col-8 col-4 my-auto" style="display:none">
            <div class="details-drop px-2 text-center">
                <p class="my-auto mb-0 font-Montserrat-ExtraBold font-size-22px py-1" style="letter-spacing: 4px">
                </p>
            </div>
        </div>
        <div class="offset-8 col-4 my-auto">
            <button id="use-code" class="input-sharp text-center">
                <p class="my-auto py-2 font-Montserrat-ExtraBold font-size-16px">Use Code</p>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-2 mt-4">
            <div class="details-drop p-4">
                <p class="font-Montserrat-ExtraBold font-size-20px">
                    <span class="pull-left">How to Redeem</span>
                    <span class="pull-right"> 
                        <i id="how-to" class="fa fa-plus fa-lg" aria-hidden="true"></i>
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
    </div>
</div>

@endsection

@section('postscript')
<script>
    $(".nav_redeem").addClass("active");

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#how-to').on('click', ()=>{
            $('#how-to-desc').empty().slideToggle(()=>{
                $('#how-to-desc').html('{{$r->reward_howto}}');
            });
        })

        $('#tnc').on('click', ()=>{
            $('#tnc-desc').empty().slideToggle(()=>{
                $('#tnc-desc').html('{{$r->reward_tnc}}');
            });
        })

        var use_state = 0;
        $('#use-code').on('click', ()=>{
            console.log('{{$c->status}}');
            $.ajax({
                url: "{{ url('/use-reward') }}",
                method: 'post',
                data: {
                    "claim_id" : "{{$c->id}}",
                },
                success: function (response) {
                    $('#code').find('p').html(response.code);
                    if (use_state == 0){
                        $('#use-code').parent().removeClass('offset-8');
                        $('#code').fadeIn();
                        use_state = 1;
                    }
                    else {
                        $('#code').fadeOut(()=>{
                            $('#use-code').parent().addClass('offset-8');
                        });
                        use_state = 0;
                    }
                }
            });
        })
    })
</script>
@endsection