@extends('layouts.app')

@section('prescript')

@endsection

@section('content')
<div class="scroller">
    <div class="container-fluid ">
        <div class="row  main-header-bg pt-5 bg-violet">
            <div class="col-1 text-left pt-2">
                <a href="/profile"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a>
            </div>
            <div class="col-11 text-center">
                <p class="font-Montserrat-ExtraBold font-size-28px FFEF41-color ">MY REFERRAL CODE</p>
            </div>
        </div>


        <div class="row bg-white p-2" style="">
            <div class="col-12 py-4 px-1 font-color-black">

                <p class="font-NunitoSans-Regular font-size-16px">You can introduce your friends and families about this
                    app, and let them register their account using
                    your referral codes.</p>
                <p class="font-NunitoSans-Regular font-size-16px">One successful registrant will rewards you get 1 FREE
                    Life <img src="{{asset('/img/life.png')}}" width="15" height="15" alt=""> ! No limitation!</p>
            </div>
        </div>

        <div class="row p-2 m-0 bg-white" style="border:3px solid #000;">
            <div class="col-8 pt-1">
                <p class="font-latobold font-size-22px text-left mb-0 font-color-black" id="refferal_number">{{$referral}}</p>
            </div>
            <div class="col-4 text-right">

                <div class="tooltips ">
                    <button class="bg-yellow-content font-Montserrat-Bold font-size-18px p-1"
                        style="border: 2px solid #000; border-radius:0;"
                        onclick="copyToClipboard('refferal_number')">
                        <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                        COPY
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('postscript')
<script>

    $(document).ready(function () {
        $(".nav_profile").addClass("active");
        $(".footer-word-profile").addClass("active");
    });
    
    function copyToClipboard(elementId) {

        var aux = document.createElement("input");
        aux.setAttribute("value", document.getElementById(elementId).innerHTML);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");
        document.body.removeChild(aux);

        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copied: " + aux.value;
    }

</script>
@endsection