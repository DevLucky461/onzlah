@extends('layouts.website')

@section('prescript')
@endsection

@section('content')

<!------------------------------------------------ 1st block start -------------------------------------------->

<div class="container-fluid bg-violet padding-top-50rem text-white">
    <div class="row">
        <div class="offset-lg-3 col-lg-6 offset-md-2 col-md-8 col-12 text-center mb-5">
            <div class="font-Montserrat-Bold font-size-42px">
                <span class="bg-lime text-violet px-3"> BE OUR PARTNERS </span>
            </div>
        </div>
        <div class="offset-lg-3"></div>
        <div class="offset-lg-2 col-lg-8 offset-md-1 col-md-10 col-12 mb-5">
            <div class="font-NunitoSans-SemiBold font-size-28px text-center">
                <p>Our vision is to be the go-to platform for brands and consumers to connect in more fun, engaging, and rewarding ways.</p>
                <p>Drop us your details here and let’s explore how we can get your brand out there!</p>
            </div>
        </div>
        <div class="offset-lg-3 col-lg-6 offset-md-2 col-md-8 offset-1 col-10 mt-3 margin-bottom-50rem">
            <form action="/register" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control input-extra-size input-sharp font-Nunito-Sans font-size-17px font-color-black p-17" placeholder="Name" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control input-extra-size input-sharp font-Nunito-Sans font-size-17px font-color-black p-17" placeholder="Company" id="company" name="company" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control input-extra-size input-sharp font-Nunito-Sans font-size-17px font-color-black p-17" placeholder="Email Address" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-extra-size input-sharp font-Nunito-Sans font-size-17px font-color-black p-17" placeholder="Phone number" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-extra-size input-sharp font-Nunito-Sans font-size-17px font-color-black p-17" placeholder="Industry / Production / Service" id="industry" name="industry">
                    </div>
                    <div class="form-group form-check">
                      <label class="form-check-label label-checkbox font-NunitoSans-Regular font-size-20px">I have read and agree with the <a id="tncpp-open"><u>Terms & Conditions and Privacy Policy.</u></a>
                        <input type="checkbox" class="checkbox-hide">
                        <span class="form-check-input font-Nunito-Sans checkbox-register"></span>
                      </label>
                    </div>
                    <div class='text-center py-3 mt-5 padding-x-150rem'>
                        <button type="submit" class="btn button-yellow font-Montserrat font-size-35px">SUBMIT</button>
                    </div>
                </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 p-0 mt-5">
            <img src="images/website/partner-btmleft.svg" alt="" class="img-fluid block-btmleft-image">
        </div>
    </div>
</div>

<!------------------------------------------------ 1th block end / footer start     -------------------------------------------->

<div class="container-fluid bg-lime text-white padding-y-50rem">
    <div class="row">
        <div class="offset-xl-3 col-xl-2 col-lg-4 offset-md-1 col-md-4 offset-sm-2 col-sm-8 offset-2 col-8">
            <div class="row">
                <div class="col-12 my-3">
                    <span class="font-Montserrat-ExtraBold font-size-25px text-black">
                        Follow Us
                    </span>
                </div>
                <div class="col-12 my-3">
                    <a href="https://www.facebook.com/onzlah.live/">
                        <img src="images/website/footer-icon-fb-dark.svg" class="img mr-3">
                        <span class="font-Montserrat-Bold font-size-22px text-black">Facebook</span>
                    </a>
                </div>
                <div class="col-12 my-3">
                    <a href="https://www.instagram.com/onzlah.live/">
                        <img src="images/website/footer-icon-ig-dark.svg" class="img mr-3">
                        <span class="font-Montserrat-Bold font-size-22px text-black">Instagram</span>
                    </a>
                </div>
                <div class="col-12 my-3">
                    <a href="https://www.youtube.com/channel/UCBSbnWxsEn2ZbNQj4YCcRsA">
                        <img src="images/website/footer-icon-youtube-dark.svg" class="img mr-3">
                        <span class="font-Montserrat-Bold font-size-22px text-black">Youtube</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 offset-sm-2 col-sm-8 offset-2 col-8">
            <div class="row">
                <div class="col-12 mt-5 mb-3">
                    <a href="/website-partner" class="font-Montserrat-Bold font-size-22px text-black">
                        Be Our Partner
                    </a>
                </div>
                <div class="col-12 my-3">
                    <span class="font-Montserrat-Bold font-size-22px text-black">
                        Privacy Policy and Terms & Conditions
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection