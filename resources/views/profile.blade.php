@extends('layouts.app')

@section('prescript')

@endsection

@section('content')

@if (session()->has('update_password'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: 'Password Updated',
            icon: 'success',
            confirmButtonText: 'Yes'
        })
    </script>
@endif
<div class="scroller">
    <div class="container-fluid main-header-bg">
        <div class="row" style="padding-top:3rem">
            <div class="col-4">
                <a href="/"><img src="{{url('images/onzlah-logo-small.png')}}" alt=""></a> 
            </div>
            <div class="col-6 text-center ">
                <p class="font-Montserrat-ExtraBold font-size-28px FFEF41-color mb-0 pt-3"> PROFILE</p>
            </div>
        </div>
    </div>

    <div class="container-fluid font-color-black">
        <div class="row p-3 bg-yellow-content">
            <div class="col-4 ">
                <div class="profile-picture-border" style="border: 2px solid #000;height: 6rem; width: 95px;">
                    <img src="{{ Auth::user()->picture}}" alt="" class="w-100 h-100" style="  object-fit: cover">
                </div>
            </div>
            
            <div class="col-8" >
                
                @if (empty(Auth::user()->name))
                    <p class="font-Montserrat-Bold font-size-20px mb-0 pt-3">No Username </p>
                @else
                    <p class="font-Montserrat-Bold font-size-35px mb-0 pt-3">{{Auth::user()? Auth::user()->name : "Invalid User"}}</p>
                @endif 
                
               
            </div>
            <div class="col-7 pr-1 py-4">
                <a href="/coins">
                    <button type="button" class="btn button-color-white button-border-custom font-Montserrat-Bold font-size-19px px-1 text-center" id="button_coins">
                        <!-- <img src="{{url('images/coin-icon.svg')}}"> {{Auth::user()? Auth::user()->coins : "you shouldn't be seeing this"}}-->
                    </button>
                </a>
            </div>
            <div class="col-5 pl-1 pt-4">
                <button type="button"
                    class="btn button-color-white button-border-custom font-Montserrat-Bold font-size-19px px-1 text-center" id="life_button">
                       <!--   <img src="{{asset('/img/life.png')}}" alt="" class="life-size"> {{Auth::user()? Auth::user()->life : "you shouldn't be seeing this"}} -->
                    
                </button>
            </div>
        </div>

        <div class="row p-3 details bg-white px-0">
            <div class="col-8">
                <a href="/edit-profile/{{Auth::user()->id}}">
                    <div class="font-NunitoSans-SemiBold font-size-18px">Edit Profile</div>
                </a>
            </div>
            <div class="col-4">
                <a href="/edit-profile/{{Auth::user()->id}}"><i class="fa fa-angle-right fa-2x pull-right"
                        aria-hidden="true"></i></a>
            </div>
            <div class="col-12">
                <hr>
            </div>

            <div class="col-8">
                <a href="/edit-password">
                    <div class="font-NunitoSans-SemiBold font-size-18px">Edit Password</div>
                </a>
            </div>
            <div class="col-4">
                <a href="/edit-password"><i class="fa fa-angle-right fa-2x pull-right"
                        aria-hidden="true"></i></a>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-8">
                <a href="/my-referral">
                    <div class="font-NunitoSans-SemiBold font-size-18px">My Referral Code</div>
                </a>
            </div>
            <div class="col-4">
                <a href="/my-referral"><i class="fa fa-angle-right fa-2x pull-right" aria-hidden="true"></i></a>
            </div>
            <div class="col-12">
                <hr>
            </div>

            <div class="col-8">
                <a href="/faq">
                    <div class="font-NunitoSans-SemiBold font-size-18px">FAQs</div>
                </a>
            </div>
            <div class="col-4">
                <a href="#"><i class="fa fa-angle-right fa-2x pull-right" aria-hidden="true"></i></a>
            </div>
            <div class="col-12">
                <hr>
            </div>

            <div class="col-8">
                <a href="/notification-settings">
                    <div class="font-NunitoSans-SemiBold font-size-18px">Notification Settings</div>
                </a>
            </div>
            <div class="col-4">
                <a href="/notification-settings"><i class="fa fa-angle-right fa-2x pull-right" aria-hidden="true"></i></a>
            </div>
            <div class="col-12">
                <hr>
            </div>
             
            <div class="col-8">
                <a href="/become-partner">
                    <div class="font-NunitoSans-SemiBold font-size-18px">Become A Partner</div>
                </a>
            </div>
            <div class="col-4">
                <a href="/become-partner"><i class="fa fa-angle-right fa-2x pull-right" aria-hidden="true"></i></a>
            </div>
            <div class="col-12">
                <hr>
            </div>

              
            <div class="col-8">
                <a href="/create_feedback">
                    <div class="font-NunitoSans-SemiBold font-size-18px">My Community</div>
                </a>
            </div>
            <div class="col-4">
                <a href="/create_feedback"><i class="fa fa-angle-right fa-2x pull-right" aria-hidden="true"></i></a>
            </div>
            <div class="col-12">
                <hr>
            </div>

                
            <!-- <div class="col-8">
                <a href="#">
                    <div class="font-NunitoSans-SemiBold font-size-18px">Our Team</div>
                </a>
            </div>
            <div class="col-4">
                <a href="#"><i class="fa fa-angle-right fa-2x pull-right" aria-hidden="true"></i></a>
            </div>
            <div class="col-12">
                <hr>
            </div> -->

                
            <!-- <div class="col-8">
                <a href="/about">
                    <div class="font-NunitoSans-SemiBold font-size-18px">About</div>
                </a>
            </div>
            <div class="col-4">
                <a href="/about"><i class="fa fa-angle-right fa-2x pull-right" aria-hidden="true"></i></a>
            </div>
            <div class="col-12">
                <hr>
            </div> -->

            <div class="col-8">
                <a href="/about">
                    <div class="font-NunitoSans-SemiBold font-size-18px">Terms & Conditions</div>
                </a>
            </div>
            <div class="col-4">
                <a href="/about"><i class="fa fa-angle-right fa-2x pull-right" aria-hidden="true"></i></a>
            </div>
            <div class="col-12">
                <hr>
            </div>
            
            <div class="col-8">
                <a href="/logout">
                    <div class="font-NunitoSans-SemiBold font-size-18px">Logout</div>
                </a>
            </div>
            <div class="col-4">
                <a href="/logout"><i class="fa fa-angle-right fa-2x pull-right" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    @endsection
    @section('postscript')
    <script>
    $(document).ready(function(){
        $(".nav_profile").addClass("active");
        $(".footer-word-profile").addClass("active");

        $('#button_coins').html("<img src='/images/coin-icon.svg'> " + numFormat({{Auth::user()->coins }}));
        $('#life_button').html("<img src='/img/life.png' width='25' height='25'> " + numFormat({{Auth::user()->life }}));
    });

    function numFormat(num) {
        var c = (num.toString().indexOf ('.') !== -1) ? num.toLocaleString() : num.toString().replace(/(\d)(?=(?:\d{3})+$)/g, '$1,');
        return c ;
    }
    </script>
    @endsection