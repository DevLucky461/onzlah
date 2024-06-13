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
                <p class="font-latobold font-size-38px mb-0 text-center">How To Play:</p>
                <br />
                <p class="font-latobold font-size-20px mb-0">1. 360 no scope</p><br>
                <p class="font-latobold font-size-20px mb-0">2. 720 no scope</p><br>
                <p class="font-latobold font-size-20px mb-0">3. 1080 no scope</p><br>
                <p class="font-latobold font-size-20px mb-0">4. Bunny hop</p><br>
                <p class="font-latobold font-size-20px mb-0">5. Repeat</p><br>
                <p class="font-latobold font-size-20px mb-0">6. Stop losing</p><br>
                <p class="font-latobold font-size-20px mb-0">7. Git gud</p><br>
                <p class="font-latobold font-size-20px mb-0">8. Grief</p><br>
                <p class="font-latobold font-size-20px mb-0">9. Smurf</p><br>
                <p class="font-latobold font-size-20px mb-0">10. Hax</p><br>
                <p class="font-latobold font-size-20px mb-0">11. Uninstall</p><br>
            </div>
        </div>
    </div>
</div>
@endsection
