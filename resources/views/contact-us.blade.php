@extends('layouts.app')

@section('prescript')
@endsection

@section('content')
<div class="container-fluid bg-red scroller">
    <div class="row">
        <div class="col-12 header-blue back-padding">
            <a href='{{url()->previous()}}'><i class="las la-angle-left la-2x text-white"></i><span class="font-markerfelt font-size-22px text-white">Back</span></a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-0">
            <img src="{{url('img/profile-banner.png')}}" class="img-fluid banner-header-full"/>
        </div>
    </div>
    <div class="row">
        <div class="col-12 py-4 px-4">
            <div class="container-fluid bg-white font-color-black p-4">
                <p class="font-latobold font-size-38px mb-0 text-center">Contact Us:</p><br>
                <br />
                <p class="font-latobold font-size-20px mb-0 text-center">Simon Salmon</p><br>
                <p class="font-latobold font-size-20px mb-0 text-center">simon.salmon@cakexp.com</p><br>
                <p class="font-latobold font-size-20px mb-0 text-center">+60127891234</p><br>
                <br />
                <p class="font-latobold font-size-20px mb-0 text-center">Samantha Pratha</p><br>
                <p class="font-latobold font-size-20px mb-0 text-center">samantha.pratha@cakexp.com</p><br>
                <p class="font-latobold font-size-20px mb-0 text-center">+60159997777</p><br>
                <br />
                <p class="font-latobold font-size-20px mb-0 text-center">Sullivan Chifan</p><br>
                <p class="font-latobold font-size-20px mb-0 text-center">sullivan.Chifan@cakexp.com</p><br>
                <p class="font-latobold font-size-20px mb-0 text-center">+60188888888</p><br>
            </div>
        </div>
    </div>
</div>
@endsection
