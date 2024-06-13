@extends('layouts.app')

@section('prescript')
<style>
    #change-image-button {
        display: none;
        text-align: center;
        vertical-align: middle;
        position: absolute;
        top: 45%;
        left: 20%;
        color: white;
        font-size: 1em;
        font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }

    #profile-photo:hover #change-image-button {
        display: block;
    }

    #profile-photo:hover #profile-src {
        opacity: 0.5;
    }

    #profile-photo {
        padding: 6px;
        display: block;
        margin-bottom: 10px;
        position: relative;
        width: 160px;
        height: 160px;
        border-color: #e2e2e2;
        background-color: #999;
        overflow: hidden;
    }

    #profile-src {
        box-sizing: border-box;
        color: rgb(85, 85, 85);
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        text-align: center;
        vertical-align: middle;
        perspective-origin: 80px 80px;
        transform-origin: 80px 80px;
        border: 0px none rgb(85, 85, 85);
        outline: rgb(85, 85, 85) none 0px;
    }

    .hiddenfile {
        width: 0px;
        height: 0px;
        overflow: hidden;
    }

</style>
@endsection

@section('content')

@if (session()->has('updated-profile'))
<script>
    Swal.fire({
        title: 'Success!',
        text: 'Profile Updated',
        icon: 'success',
        confirmButtonText: 'Yes'
    })

</script>
@endif

<div class="container-fluid scroller">
    
        <div class="row main-header-bg" style="padding-top:5rem">
            <div class="col-2 text-left pt-2">
                <a href="/profile"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a>
            </div>
            <div class="col-8 text-center ">
                <p class="font-Montserrat-ExtraBold font-size-28px FFEF41-color ">EDIT PROFILE</p>
            </div>
            <div class="col-2 text-center">
            </div>
        </div>

        <div class="row">
            <div class="col-12 px-0">
                <div class="font-color-black p-4 " style="background-color: rgb(234, 234, 234);">
                    <div class="w-100 flex-center">
                        <div id="profile-photo">
                            <img src="/{{$user->picture}}" id="profile-src" />
                        </div>
                    </div>
                    <div class="hiddenfile">
                        <input name="profile-picture" type="file" id="fileinput" />
                    </div>
                </div>
                <div class="col-12 hr-border"></div>
            </div>
        </div>
      
 
        <form action="/update-profile" method="post" enctype="multipart/form-data">
            @csrf
                    <div class="row bg-white font-color-black p-4">
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password" class="font-Nunito-Sans font-size-16px mb-0">Login
                                    Username</label>
                                <input type="text" class="form-control form-control-lg input-border" name="name"
                                    value="{{$user->name}}">
                            </div>
                        </div>

                        @error('name')
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible fade show">{{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        </div>
                        @enderror
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email" class="font-Nunito-Sans font-size-16px mb-0">Email Address</label>
                                <div class="inline pull-right" id="suggested-email" style="display: none">

                                </div>
                                <input id="email" type="email" class="form-control form-control-lg input-border"
                                    name="email" value="{{$user->email}}">
                            </div>
                        </div>

                        @error('email')
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible fade show">{{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @enderror
                        <div class="col-12">
                            <div class="form-group">
                                <label for="phone" class="font-Nunito-Sans font-size-16px mb-0">Phone Number</label>
                                <input type="text" class="form-control form-control-lg input-border" name="phone"
                                    value="{{$user->phonenumber}}">
                            </div>
                        </div>

                        @error('phone')
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible fade show">{{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @enderror

                       <!-- @if ($user->fullname)
                        <div class="col-12">
                            <div class="form-group">
                                <label for="phone" class="font-Nunito-Sans font-size-16px mb-0">FullName</label>
                                <input type="text" class="form-control form-control-lg input-border" name="fullname2"
                                    value="{{$user->fullname}}">
                            </div>
                        </div>

                        @endif

                        @if($user->dateofbirth)
                        <div class="col-12">
                            <div class="form-group">
                                <label class="font-Nunito-Sans font-size-16px mb-0">Date of Birth</label>
                                <input type="date" class="form-control form-control-lg input-border " name="dateofbirth2"
                                    value="{{$user->dateofbirth}}">
                            </div>
                        </div>

                        @endif

                        @if($user->current_states)
                        <div class="col-12">
                            <div class="form-group">
                                <label class="font-Nunito-Sans font-size-16px mb-0">Current State</label>
                                <select class="form-control form-control-lg input-extra-size-select input-border w-91"
                                    name="current_state2" onchange="change_city_2()">
                                    @if($user->current_states == "")
                                    <option>Pick a State</option>
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Johor")
                                    <option value="Johor" selected>Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Kedah")
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah" selected>Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Kelantan")
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan" selected>Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Kuala Lumpur")
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur" selected>Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Malacca")
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca" selected>Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Negeri Sembilan")
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan" selected>Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Pahang")
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang" selected>Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Perak")
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak" selected>Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Perlis")
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis" selected>Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Penang")
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang" selected>Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Sabah")
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca" selected>Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Sarawak")
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak" selected>Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Selangor")
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor" selected>Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    @elseif($user->current_states == "Terengganu")
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu" selected>Terengganu</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        @endif

                        @if($user->current_city)
                        <div class="col-12">
                            <div class="form-group">
                                <label for="gender" class="font-Nunito-Sans font-size-16px mb-0">City</label>
                                <select class="form-control form-control-lg input-extra-size-select input-border w-91" name="current_city2" readonly style="pointer-events: none !important;">
                                        <option value="{{$user->current_city}}" selected>{{$user->current_city}}</option>
                                </select>
                            </div>
                        </div>
                        @endif

                        @if($user->gender)
                        <div class="col-12">
                            <div class="form-group">
                                <label for="gender" class="font-Nunito-Sans font-size-16px mb-0">Gender</label>
                                <select class="form-control form-control-lg input-extra-size-select input-border w-91" name="gender2" >
                                    @if($user->gender == "Male")
                                        <option value="Male" selected>Male</option>
                                        <option value="Female" >Female</option>
                                    @elseif($user->gender == "Female")
                                        <option value="Male" >Male</option>
                                        <option value="Female" selected>Female</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        @endif -->

                        <div class="col-12 text-center py-3">
                            <button id="submit-button" type="submit"
                                class="btn bg-yellow-content font-size-30px font-Montserrat-Bold btn-block"
                                style="border: 4px solid rgb(0, 0, 0);">SAVE PROFILE</button>
                        </div>
                    </div>
                </form>
            <div class="row">
                <div class="col-12 hr-border"></div>
            </div>
    

    <div class="row" id="extraprofile">
        <div class="col-12 px-0">
            <div class="container-fluid bg-pink font-color-black p-4">
                <div class="row">
                    <div class="col-12 mt-3">
                        <h2 class="font-Montserrat font-color-black font-size-24px mb-0">Update Profile</h2>
                        <div class="text-left">
                            <hr class="hr-custom">
                        </div>
                        <p class="font-NunitoSans-Regular font-size-16px font-color-black">Tell us more about yourself, so we know what redemption suit you more!</p>
                        <p class="font-NunitoSans-Regular font-size-16px font-color-black">5000 coins FREE once you complete and submit your profile</p>
                    </div>


                    <div class="col-12" id="fullname">
                        <div class="form-border bg-white p-3">
                            <p class="violet-text-color font-Montserrat-Bold font-size-16px">Question 1/5</p>
                            <div class="form-group">
                                <label for="password" class="font-Nunito-Sans font-size-16px mb-0">Full
                                    Name</label>
                                <input type="text" class="form-control form-control-lg border-black-2px" name="fullname"
                                    value="{{$user->fullname}}" placeholder="Enter Full Name">
                            </div>
                            <div class="text-right ">
                                <button class="form-border px-3 py-2 bg-lime" onclick="view_dob()">
                                    <img src="{{ asset('/assets2/icon/right-arrow.png') }} " alt="">
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="col-12" id="dob">
                        <div class="form-border bg-white p-3">
                            <p class="violet-text-color font-Montserrat-Bold font-size-16px">Question 2/5</p>
                            <div class="form-group">
                                <label class="font-Nunito-Sans font-size-16px mb-0">Date of Birth</label>
                                <input type="date" class="form-control form-control-lg border-black-2px"
                                    name="dateofbirth" value="{{$user->dateofbirth}}">
                            </div>

                            <div class="text-right ">
                                <button class="form-border px-3 py-2 bg-lime" onclick="view_state()">
                                    <img src="{{ asset('/assets2/icon/right-arrow.png') }} " alt="">
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="col-12" id="state">
                        <div class="form-border bg-white p-3">
                            <p class="violet-text-color font-Montserrat-Bold font-size-16px">Question 3/5</p>

                            <div class="form-group">
                                <label class="font-Nunito-Sans font-size-16px mb-0">Current State</label>
                                <select class="form-control form-control-lg border-black-2px" name="current_state"
                                    onchange="change_city()">
                                    <option value="pickstate">Pick a State</option>
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                </select>
                            </div>

                            <div class="text-right ">
                                <button class="form-border px-3 py-2 bg-lime" onclick="view_city()">
                                    <img src="{{ asset('/assets2/icon/right-arrow.png') }} " alt="">
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="col-12" id="city">
                        <div class="form-border bg-white p-3">
                            <p class="violet-text-color font-Montserrat-Bold font-size-16px">Question 4/5</p>

                            <div class="form-group">
                                <label class="font-Nunito-Sans font-size-16px mb-0">Current City</label>
                                <select class="form-control form-control-lg border-black-2px " name="current_city">
                                </select>
                            </div>


                            <div class="text-right ">
                                <button class="form-border px-3 py-2 bg-lime" onclick="view_gender()">
                                    <img src="{{ asset('/assets2/icon/right-arrow.png') }} " alt="">
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="col-12" id="gender">
                        <div class="form-border bg-white p-3">
                            <p class="violet-text-color font-Montserrat-Bold font-size-16px">Question 5/5</p>

                            <div class="form-group">
                                <label for="gender" class="font-Nunito-Sans font-size-16px mb-0">Gender</label>
                                <select class="form-control form-control-lg border-black-2px" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="text-right ">
                                <button class="form-border px-3 py-2 bg-lime" onclick="gender()">
                                    <img src="{{ asset('/assets2/icon/right-arrow.png') }} " alt="">
                                </button>
                            </div>
                        </div>

                    </div>
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

        $('#dob').hide();
        $('#state').hide();
        $('#city').hide();
        $('#gender').hide();


        if ('{{$user->fullname}}' != "") {
            //console.log("data");
            $('#fullname').hide();
            $('#dob').show();
        }

        if ('{{$user->dateofbirth}}' != "") {
            //console.log("data");
            $('#fullname').hide();
            $('#dob').hide();
            $('#state').show();
        }

        if ('{{$user->current_states}}' != "") {
            //console.log("data");
            $('#fullname').hide();
            $('#dob').hide();
            $('#state').hide();

            var selangor = ["Gombak", "Hulu Langat", "Hulu Selangor", "Klang", "Kuala Langat", "Kuala Selangor",
                "Petaling Jaya", "Sabak Bernam", "Sepang"
            ];
            var kedah = ["Baling", "Bandar Baharu", "Kota Setar", "Kuala Muda", "Kubang Pasu", "Kulim",
                "Pulau Langkawi ",
                "Padang Terap", "Pendang", "Pokok Sena", "Sik", "Yan"
            ];
            var melaka = ["Tangga Batu", "Hang Tuah Jaya", "Kota Melaka", "Sungai Udang", "Pantai Kundor",
                "Paya Rumput",
                "Klebang", "Pengkalan Batu", "Ayer Keroh", "Bukit Katil",
                "Ayer Molek", "Kesidang", "Kota Laksamana", "Duyong", "Bandar Hilir", "Telok Mas"
            ];
            var johor = ["Batu Pahat", "Johor Bahru", "Kluang", "Kota Tinggi", "Kulai", "Mersing", "Muar",
                "Pontian Kechil",
                "Segamat", "Tangkak"
            ];
            var pahang = ["Bera", "Bentong", "Cameron Highlands", "Jerantut", "Kuantan", "Lipis", "Maran",
                "Pekan", "Raub",
                "Rompin", "Temerloh"
            ];
            var terengganu = ["Besut", "Setiu", "Dungun", "Hulu Terengganu", "Marang", "Kemaman",
                "Kuala Terengganu",
                "Kuala Nerus"
            ];
            var perak = ["Batang Padang", "Manjung", "Kinta", "Kerian", "Kuala Kangsar", "Laut", "Hilir Perak",
                "Hulu Perak", "Selama", "Perak Tengah", "Kampar", "Muallim", "Bagan Datuk"
            ];
            var perlis = ["Arau", "Chuping", "Kaki Bukit", "Kuala Perlis", "Sanglang", "Padang Besar"];
            var sabah = ["Kota Belud", "Kota Kinabalu", "Papar", "penampang", "Putatan", "Ranau", "Tuaran",
                "Beaufort",
                "Nabawan", "Keninggau", "Kuala Penyu", "Sipitang", "Tambunan", "Tenom",
                "Kota Marudu", "Kudat", "Pitas", "Beluran", "Kinabatangan", "Sandakan", "Telupid", 'Tongod',
                "Kunak",
                "Lahad Datu", "Semporna", "Tawau"
            ];
            var sarawak = ["Kuching", "Sri Aman", "Sibu", "Miri", "Limbang", "Sarikei", "Kapit", "Samarahan",
                "Bintulu",
                "Betong", "Mukah", "Serian"
            ];
            var n9 = ["Seremban", "Port Dickson", "Rembau", "Jelebu", "Kuala Pilah", "Jempol", "Tampin"];
            var penang = ["Bukit Mertajam", "Seberang Perai", "Balik Pulau", "Bayan Lepas", "Butterworth",
                "Jelutong",
                "Kepala Batas", "Perai", 'Pematang Pauh', "Teluk Bahang"
            ];
            var kelantan = ["Bachok", "Gua Musang", "Jeli", "Kota Bharu", "Kuala Krai", "Machang", "Pasir Mas",
                "Pasir Putih", "Tanah Merah", "Tumpat"
            ];
            var kualalumpur = ["Bukit Bintang", "Titiwangsa", "Setiawangsa", "Wangsa Maju", "Kepong"];

            switch ('{{$user->current_states}}') {
                case "Johor":
                    johor.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;
                case "Kedah":
                    kedah.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;
                case "Kelantan":
                    kelantan.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;
                case "Kuala Lumpur":
                    kualalumpur.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;
                case "Malacca":
                    melaka.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;
                case "Negeri Sembilan":
                    n9.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;
                case "Pahang":
                    pahang.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;
                case "Perak":
                    perak.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;
                case "Perlis":
                    perlis.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;
                case "Penang":
                    penang.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;
                case "Sabah":
                    sabah.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;
                case "Sarawak":
                    sarawak.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;
                case "Selangor":
                    selangor.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;
                case "Terengganu":
                    terengganu.forEach(function (item, index) {
                        $('select[name=current_city]').append(" <option value='" + item + "'>" + item +
                            "</option>")
                    })
                    break;

            }
            $('#city').show();
        }

        if ('{{$user->current_city}}' != "") {
            //console.log("data");
            $('#fullname').hide();
            $('#dob').hide();
            $('#state').hide();
            $('#city').hide();
            $('#gender').show();
        }

        if ('{{$user->gender}}' != "") {
            $('#extraprofile').hide();
        }


        // $('select[name=current_city]').append("<option value="+ {{Auth::user()->current_city}}  +">"+ {{Auth::user()->current_city}} +"</option>");


        $('#fileinput').change(function () {

            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" ||
                    ext == "jpg" || ext == "jfif")) {

                //console.log(input.files);
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile-src').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

        var timeout_email = null;
        $('#email').on('keyup', function () {
            $('#suggested-email').fadeOut();
            clearTimeout(timeout_email);
            if ($('#email').val() != '') {
                timeout_email = setTimeout(function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ url('/register-check-edit') }}",
                        method: 'post',
                        data: {
                            "type": 'email',
                            "email": $('#email').val(),
                        },
                        success: function (response) {
                            if (response.status == 'available') {
                                $('#suggested-email').html('Email available')
                                    .fadeIn();
                                $('#submit-button').removeClass('bg-gray-content')
                                    .addClass('bg-yellow-content').removeAttr(
                                        'disabled');
                            } else if (response.status == 'unavailable') {
                                $('#suggested-email').html('Email unavailable')
                                    .fadeIn();
                                $('#submit-button').removeClass('bg-yellow-content')
                                    .addClass('bg-gray-content').attr('disabled',
                                        'disabled');
                            }
                        }
                    });
                }, 500)
            }

        })

    });

    function view_dob() {
        if ($('input[name=fullname]').val() == "") {} else {
            ajax_setup();
            $.ajax({
                url: "{{ url('/add-fullname') }}",
                method: 'post',
                data: {
                    "fullname": $('input[name=fullname]').val(),
                },
                success: function (response) {
                    $('#fullname').hide();
                    $('#dob').fadeIn();
                }
            });

        }
    }

    function view_state() {
        //console.log($('input[name=dateofbirth]').val());
        if ($('input[name=dateofbirth]').val() == "") {} else {
            ajax_setup();
            $.ajax({
                url: "{{ url('/add-dob') }}",
                method: 'post',
                data: {
                    "dob": $('input[name=dateofbirth]').val(),
                },
                success: function (response) {
                    $('#dob').hide();
                    $('#state').fadeIn();
                }
            });

        }
    }

    function view_city() {
        if ($('select[name=current_state]').val() == "pickstate") {} else {
            ajax_setup();
            $.ajax({
                url: "{{ url('/add-current-state') }}",
                method: 'post',
                data: {
                    "current_state": $('select[name=current_state]').val(),
                },
                success: function (response) {
                    $('#state').hide();
                    $('#city').fadeIn();
                }
            });

        }
    }

    function view_gender() {
        if ($('select[name=current_city]').val() == "") {} else {
            ajax_setup();

            $.ajax({
                url: "{{ url('/add-current-city') }}",
                method: 'post',
                data: {
                    "current_city": $('select[name=current_city]').val(),
                },
                success: function (response) {
                    $('#city').hide();
                    $('#gender').fadeIn();
                }
            });

        }
    }

    function gender() {
        ajax_setup();

        $.ajax({
            url: "{{ url('/add-gender') }}",
            method: 'post',
            data: {
                "gender": $('select[name=gender]').val(),
            },
            success: function (response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'You have just earned 5000 coins!',
                    icon: 'success',
                    confirmButtonText: 'Yes'
                });
                $('#extraprofile').hide();
            }
        });
        console.log();
    }

    function ajax_setup() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }


    function trigger_file() {
        $('#fileinput').trigger('click');
    }

    function change_city() {
        var selangor = ["Gombak", "Hulu Langat", "Hulu Selangor", "Klang", "Kuala Langat", "Kuala Selangor",
            "Petaling Jaya", "Sabak Bernam", "Sepang"
        ];
        var kedah = ["Baling", "Bandar Baharu", "Kota Setar", "Kuala Muda", "Kubang Pasu", "Kulim", "Pulau Langkawi ",
            "Padang Terap", "Pendang", "Pokok Sena", "Sik", "Yan"
        ];
        var melaka = ["Tangga Batu", "Hang Tuah Jaya", "Kota Melaka", "Sungai Udang", "Pantai Kundor", "Paya Rumput",
            "Klebang", "Pengkalan Batu", "Ayer Keroh", "Bukit Katil",
            "Ayer Molek", "Kesidang", "Kota Laksamana", "Duyong", "Bandar Hilir", "Telok Mas"
        ];
        var johor = ["Batu Pahat", "Johor Bahru", "Kluang", "Kota Tinggi", "Kulai", "Mersing", "Muar", "Pontian Kechil",
            "Segamat", "Tangkak"
        ];
        var pahang = ["Bera", "Bentong", "Cameron Highlands", "Jerantut", "Kuantan", "Lipis", "Maran", "Pekan", "Raub",
            "Rompin", "Temerloh"
        ];
        var terengganu = ["Besut", "Setiu", "Dungun", "Hulu Terengganu", "Marang", "Kemaman", "Kuala Terengganu",
            "Kuala Nerus"
        ];
        var perak = ["Batang Padang", "Manjung", "Kinta", "Kerian", "Kuala Kangsar", "Laut", "Hilir Perak",
            "Hulu Perak", "Selama", "Perak Tengah", "Kampar", "Muallim", "Bagan Datuk"
        ];
        var perlis = ["Arau", "Chuping", "Kaki Bukit", "Kuala Perlis", "Sanglang", "Padang Besar"];
        var sabah = ["Kota Belud", "Kota Kinabalu", "Papar", "penampang", "Putatan", "Ranau", "Tuaran", "Beaufort",
            "Nabawan", "Keninggau", "Kuala Penyu", "Sipitang", "Tambunan", "Tenom",
            "Kota Marudu", "Kudat", "Pitas", "Beluran", "Kinabatangan", "Sandakan", "Telupid", 'Tongod', "Kunak",
            "Lahad Datu", "Semporna", "Tawau"
        ];
        var sarawak = ["Kuching", "Sri Aman", "Sibu", "Miri", "Limbang", "Sarikei", "Kapit", "Samarahan", "Bintulu",
            "Betong", "Mukah", "Serian"
        ];
        var n9 = ["Seremban", "Port Dickson", "Rembau", "Jelebu", "Kuala Pilah", "Jempol", "Tampin"];
        var penang = ["Bukit Mertajam", "Seberang Perai", "Balik Pulau", "Bayan Lepas", "Butterworth", "Jelutong",
            "Kepala Batas", "Perai", 'Pematang Pauh', "Teluk Bahang"
        ];
        var kelantan = ["Bachok", "Gua Musang", "Jeli", "Kota Bharu", "Kuala Krai", "Machang", "Pasir Mas",
            "Pasir Putih", "Tanah Merah", "Tumpat"
        ];
        var kualalumpur = ["Bukit Bintang", "Titiwangsa", "Setiawangsa", "Wangsa Maju", "Kepong"];

        $('select[name=current_city]').empty();

        $('#current_city').fadeIn();

        switch ($('select[name=current_state]').val()) {
            case "Johor":
                johor.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Kedah":
                kedah.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Kelantan":
                kelantan.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Kuala Lumpur":
                kualalumpur.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Malacca":
                melaka.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Negeri Sembilan":
                n9.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Pahang":
                pahang.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Perak":
                perak.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Perlis":
                perlis.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Penang":
                penang.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Sabah":
                sabah.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Sarawak":
                sarawak.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Selangor":
                selangor.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Terengganu":
                terengganu.forEach(function (item, index) {
                    $('select[name=current_city]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;

        }
    }

    function change_city_2() {
        var selangor = ["Gombak", "Hulu Langat", "Hulu Selangor", "Klang", "Kuala Langat", "Kuala Selangor",
            "Petaling Jaya", "Sabak Bernam", "Sepang"
        ];
        var kedah = ["Baling", "Bandar Baharu", "Kota Setar", "Kuala Muda", "Kubang Pasu", "Kulim", "Pulau Langkawi ",
            "Padang Terap", "Pendang", "Pokok Sena", "Sik", "Yan"
        ];
        var melaka = ["Tangga Batu", "Hang Tuah Jaya", "Kota Melaka", "Sungai Udang", "Pantai Kundor", "Paya Rumput",
            "Klebang", "Pengkalan Batu", "Ayer Keroh", "Bukit Katil",
            "Ayer Molek", "Kesidang", "Kota Laksamana", "Duyong", "Bandar Hilir", "Telok Mas"
        ];
        var johor = ["Batu Pahat", "Johor Bahru", "Kluang", "Kota Tinggi", "Kulai", "Mersing", "Muar", "Pontian Kechil",
            "Segamat", "Tangkak"
        ];
        var pahang = ["Bera", "Bentong", "Cameron Highlands", "Jerantut", "Kuantan", "Lipis", "Maran", "Pekan", "Raub",
            "Rompin", "Temerloh"
        ];
        var terengganu = ["Besut", "Setiu", "Dungun", "Hulu Terengganu", "Marang", "Kemaman", "Kuala Terengganu",
            "Kuala Nerus"
        ];
        var perak = ["Batang Padang", "Manjung", "Kinta", "Kerian", "Kuala Kangsar", "Laut", "Hilir Perak",
            "Hulu Perak", "Selama", "Perak Tengah", "Kampar", "Muallim", "Bagan Datuk"
        ];
        var perlis = ["Arau", "Chuping", "Kaki Bukit", "Kuala Perlis", "Sanglang", "Padang Besar"];
        var sabah = ["Kota Belud", "Kota Kinabalu", "Papar", "penampang", "Putatan", "Ranau", "Tuaran", "Beaufort",
            "Nabawan", "Keninggau", "Kuala Penyu", "Sipitang", "Tambunan", "Tenom",
            "Kota Marudu", "Kudat", "Pitas", "Beluran", "Kinabatangan", "Sandakan", "Telupid", 'Tongod', "Kunak",
            "Lahad Datu", "Semporna", "Tawau"
        ];
        var sarawak = ["Kuching", "Sri Aman", "Sibu", "Miri", "Limbang", "Sarikei", "Kapit", "Samarahan", "Bintulu",
            "Betong", "Mukah", "Serian"
        ];
        var n9 = ["Seremban", "Port Dickson", "Rembau", "Jelebu", "Kuala Pilah", "Jempol", "Tampin"];
        var penang = ["Bukit Mertajam", "Seberang Perai", "Balik Pulau", "Bayan Lepas", "Butterworth", "Jelutong",
            "Kepala Batas", "Perai", 'Pematang Pauh', "Teluk Bahang"
        ];
        var kelantan = ["Bachok", "Gua Musang", "Jeli", "Kota Bharu", "Kuala Krai", "Machang", "Pasir Mas",
            "Pasir Putih", "Tanah Merah", "Tumpat"
        ];
        var kualalumpur = ["Bukit Bintang", "Titiwangsa", "Setiawangsa", "Wangsa Maju", "Kepong"];

        $('select[name=current_city2]').removeAttr('readonly').removeAttr('style');
        $('select[name=current_city2]').empty();

        switch ($('select[name=current_state2]').val()) {
            case "Johor":
                johor.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Kedah":
                kedah.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Kelantan":
                kelantan.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Kuala Lumpur":
                kualalumpur.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Malacca":
                melaka.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Negeri Sembilan":
                n9.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Pahang":
                pahang.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Perak":
                perak.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Perlis":
                perlis.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Penang":
                penang.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Sabah":
                sabah.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Sarawak":
                sarawak.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Selangor":
                selangor.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;
            case "Terengganu":
                terengganu.forEach(function (item, index) {
                    $('select[name=current_city2]').append(" <option value='" + item + "'>" + item + "</option>")
                })
                break;

        }
    }

</script>

@endsection