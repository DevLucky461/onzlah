@extends('layouts.blank-app')

@section('prescript')
@endsection

@section('content')
<div class="container-fluid scroller-nofooter onzlah-bg">
    <div class="row">
        <div class="col-12 text-center pt-4">
            <div class="onzlah-splash-logo text-center">
                <img src="https://onzlah.lux-api.me/images/onzlah-logo-png.png" class="img-center-content">
            </div>
        </div>
        <div class="col-12 text-center">
            <div class="text-white text-center">
                <h5 class="font-Nunito-Sans font-size-28px">Play! Earn! Spend!</h5>
            </div>
        </div>
        <div class="col-12 text-center p-3">
            <a class="btn button-yellow font-Montserrat font-size-35px mb-3" href="/register">SIGN UP</a>
            <a class="btn button-white font-Montserrat font-size-35px mb-4" href="/login">LOG IN</a>
            <p><a class="text-white text-center forgot font-size-14px font-Montserrat" href="/forgot-password">Forgot Username/Password</a></p>
        </div>
        <div class="col-12 text-center">
            <p class="text-white text-center text-underline font-size-18px font-Montserrat"><a href="#" class="color-white links">How to play?</a></p>
        </div>
    </div>
</div>
@endsection
