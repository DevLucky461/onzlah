@extends('layouts.website')

@section('prescript')
    <style>
        .block-3-profile{
            width: 200px;
        }
        .block-2-img-height{
            height: 125px;
            margin-bottom: 2rem;
        }
        .special-offset{
            margin-left: 12%;
        }
        @media screen and (max-width: 1440px){
            .font-size-17px{
                font-size:13px;
            }
            .font-size-18px{
                font-size:14px;
            }
            .font-size-20px{
                font-size:16px;
            }
            .font-size-22px{
                font-size:18px;
            }
            .font-size-25px{
                font-size:21px;
            }
            .font-size-28px{
                font-size:24px;
            }
            .font-size-35px{
                font-size:31px;
            }
            .font-size-42px{
                font-size:37px;
            }
        }
        @media screen and (max-width: 768px){
            .special-offset{
                margin-left: unset;
            }
            .font-size-17px{
                font-size:13px;
            }
            .font-size-18px{
                font-size:14px;
            }
            .font-size-20px{
                font-size:16px;
            }
            .font-size-22px{
                font-size:18px;
            }
            .font-size-25px{
                font-size:21px;
            }
            .font-size-28px{
                font-size:23px;
            }
            .font-size-35px{
                font-size:30px;
            }
            .font-size-42px{
                font-size:36px;
            }
            .block-2-desc{
                padding-left: 20%;
                padding-right: 20%;
            }
        }
        @media screen and (max-width: 425px){
            .font-size-17px{
                font-size:13px;
            }
            .font-size-18px{
                font-size:14px;
            }
            .font-size-20px{
                font-size:15px;
            }
            .font-size-22px{
                font-size:17px;
            }
            .font-size-25px{
                font-size:20px;
            }
            .font-size-28px{
                font-size:22px;
            }
            .font-size-35px{
                font-size:28px;
            }
            .font-size-42px{
                font-size:34px;
            }
            .block-2-desc{
                padding-left: 0;
                padding-right: 0;
            }
        }
    </style>
@endsection

@section('content')

<!------------------------------------------------ 1st block start -------------------------------------------->

<div class="container-fluid bg-violet" style="overflow:hidden">
    <div class="row margin-bottom-100rem">
        <div class="col-lg-6 col-12 col-xs-12 col-sm-12 my-auto px-0 block-1-onzlah">
            <img src="images/website/block-1.png" alt="" class="img-fluid sharpbox-bold">
        </div>
        <div class="col-lg-7 col-12 col-xs-12 col-sm-12 my-auto px-0">
        </div>
        <div class="col-lg-5 col-12 col-xs-12 col-sm-12 pr-0" style="margin-top: 10%">
            <div class="sharpbox-bold bg-white px-3 py-5 text-center" style="border-right-width:30px">
                <span class="font-Montserrat-ExtraBold font-size-42px" style="border-right-width:10px">Malaysia’s Latest Locally Produced Online Game Show</span>
            </div>
            <img src="images/website/block-1-text-shadow.svg" alt="" class="img-fluid w-100" style="position:absolute">
        </div>
    </div>
    <div class="row" style="z-index: 10; position:relative">
        <div class="offset-lg-1 col-lg-5 offset-1 col-11">
            <p class="font-Nunito-Sans font-size-28px text-white my-5">
                OnzLAH is a multiplayer game platform which hosts 30-minute live game shows on weekdays featuring popular KOL hosts, with in-game winnings OnzLAH! Coins and exclusive brand deals.
            </p>
            <p class="font-Nunito-Sans font-size-28px text-white">
                In this app, players get to PLAY! EARN! SPEND! without spending a dime!
            </p>
        </div>
        <div class="col-lg-5 col-11">
            <img src="images/website/block-1-mobile.png" alt="" class="img-fluid">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 p-0 mt-5">
            <img src="images/website/block-1-btmleft.svg" alt="" class="img-fluid block-btmleft-image">
            <img src="images/website/block-1-btmright.svg" alt="" class="img-fluid block-btmright-image">
        </div>
    </div>
</div>

<!------------------------------------------------ 1st block end / 2nd block start  -------------------------------------------->

<div id="how-to-play" class="container-fluid bg-yellow-content pt-5">
    <div class="row block-2-row-1-margin">
        <div class="offset-lg-3 col-lg-6 col-12 text-center">
            <div class="font-Montserrat-Bold font-size-42px">
                <span class="bg-lime text-violet px-3"> HOW TO PLAY </span>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="offset-2 col-8">
            <div class="font-NunitoSans-SemiBold font-size-28px text-center">
                <span class="">Watch the live show, answer trivia questions, and win OnzLAH! Coins which you can use to redeem branded goodies and instant rewards!</span>
            </div>
        </div>
    </div>
    <div class="row margin-top-75rem text-center">
        <div class="offset-lg-3 col-lg-3 offset-xl-3 col-xl-3 mb-2">
            <img src="images/website/block-2-download.png" alt="" class="img-fluid block-2-img-height">
            <p class="font-NunitoSans-SemiBold font-size-18px mt-3 block-2-desc">Download the OnzLAH! app for free via the Apple App Store or Google Play Store on your mobile device.</p>
        </div>
        <div class="col-lg-3 col-xl-3 mb-2">
            <img src="images/website/block-2-signup.png" alt="" class="img-fluid block-2-img-height">
            <p class="font-NunitoSans-SemiBold font-size-18px mt-3 block-2-desc">Sign up with your email, then verify it, and you can start your OnzLAH! journey.</p>
        </div>
    </div>
    <div class="row text-center mt-5">
        <div class="offset-lg-2 col-lg-3 offset-xl-2 col-xl-3 mb-2 special-offset">
            <img src="images/website/block-2-play.png" alt="" class="img-fluid block-2-img-height">
            <p class="font-NunitoSans-SemiBold font-size-18px mt-3 block-2-desc">Watch OnzLAH! Live on every Monday to Friday, 12.00PM - 12.30PM and play with us.</p>
        </div>
        <div class="col-lg-3 col-xl-3 mb-2">
            <img src="images/website/block-2-earn.png" alt="" class="img-fluid block-2-img-height">
            <p class="font-NunitoSans-SemiBold font-size-18px mt-3 block-2-desc">Get all questions correct to earn coins from OnzLAH! without spending any of your own money.</p>
        </div>
        <div class="col-lg-3 col-xl-3 mb-2">
            <img src="images/website/block-2-spend.png" alt="" class="img-fluid block-2-img-height">
            <p class="font-NunitoSans-SemiBold font-size-18px mt-3 block-2-desc">With your coins, you can redeem items from OnzLAH! Redemption every day!</p>
        </div>
    </div>
    <div class="row margin-bottom-75rem text-center pt-3">
    </div>
    <div class="row" style="z-index: 5">
        <div class="col-lg-12 p-0">
            <img src="images/website/block-2-btmleft.png" alt="" class="img-fluid block-btmleft-image">
        </div>
    </div>
</div>

<!------------------------------------------------ 2nd block end / 3rd block start  -------------------------------------------->

<div id="FAQ" class="container-fluid padding-y-50rem">
    <div class="row">
        <div class="offset-3 col-6 text-center">
            <div class="font-Montserrat-Bold font-size-42px">
                <span class="bg-lime text-violet px-3"> FAQ </span>
            </div>
        </div>
    </div>
    <div class="row block-2-row-1-margin">
        <div class="offset-lg-3 col-lg-6">
            <div class="font-NunitoSans-ExtraBold font-size-35px">
                <span>What is OnzLAH?</span>
            </div>
        </div>
        <div class="offset-lg-3 col-lg-6 mt-3">
            <div class="font-NunitoSans-SemiBold font-size-22px">
                <p>OnzLAH! is the first locally produced game show by an event agency, where players can play, earn, and spend! The 30-minute live game show features:</p>
                <p><img src="images/website/block-3-pointer.png" class="img mr-2">Shows 5 days per week</p>
                <p><img src="images/website/block-3-pointer.png" class="img mr-2">KOL hosts</p>
                <p><img src="images/website/block-3-pointer.png" class="img mr-2">In-game winnings (in OnzLAH! Coins form)</p>
                <p><img src="images/website/block-3-pointer.png" class="img mr-2">Exclusive brand deals</p>
                <p><img src="images/website/block-3-pointer.png" class="img mr-2">Online multiplayer gaming platform</p>
            </div>
        </div>
    </div>

    <div class="row block-2-row-1-margin">
        <div class="offset-lg-3 col-lg-6">
            <div class="font-NunitoSans-ExtraBold font-size-35px">
                <span>Who is OnzLAH! created for?</span>
            </div>
        </div>
        <div class="offset-lg-3 col-lg-6 mt-3">
            <div class="font-NunitoSans-SemiBold font-size-22px">
                <p>Another IP platform established, hosted and operated by HotShoesAsia with the intention of connecting brands to Malaysian youth, especially students, young working adults, “stay-at-homers” and online shopaholics.</p>
            </div>
        </div>
    </div>

    <div class="row block-2-row-1-margin">
        <div class="offset-lg-3 col-lg-6">
            <div class="font-NunitoSans-ExtraBold font-size-35px">
                <span>How do I know how many coins I’ve earned?</span>
            </div>
        </div>
        <div class="offset-lg-3 col-lg-6 mt-3">
            <div class="font-NunitoSans-SemiBold font-size-22px">
                <p>Simple, tap the “Profile” icon and your coins will be listed under your username.</p>
                <img src="images/website/block-3-profile.png" alt="" class="img-fluid block-3-profile">
            </div>
        </div>
    </div>

    <div class="row block-2-row-1-margin">
        <div class="offset-lg-3 col-lg-6">
            <div class="font-NunitoSans-ExtraBold font-size-35px">
                <span>How do I redeem rewards in the app?</span>
            </div>
        </div>
        <div class="offset-lg-3 col-lg-6 mt-3">
            <div class="font-NunitoSans-SemiBold font-size-22px">
                <p>Once you’ve earned enough OnzLAH! Coins, you can click on “Redeem” icon on the menu bar and enjoy various rewards that interest you.</p>
            </div>
        </div>
    </div>

    <div class="row block-2-row-1-margin">
        <div class="offset-lg-3 col-lg-6">
            <div class="font-NunitoSans-ExtraBold font-size-35px">
                <span>Can my coins be converted into real cash?</span>
            </div>
        </div>
        <div class="offset-lg-3 col-lg-6 mt-3">
            <div class="font-NunitoSans-SemiBold font-size-22px">
                <p>No, for security purposes, OnzLAH! Coins can only be used for in-app redemptions.</p>
            </div>
        </div>
    </div>

    <div class="row block-2-row-1-margin">
        <div class="offset-lg-3 col-lg-6">
            <div class="font-NunitoSans-ExtraBold font-size-35px">
                <span>When can I redeem the rewards?</span>
            </div>
        </div>
        <div class="offset-lg-3 col-lg-6 mt-3">
            <div class="font-NunitoSans-SemiBold font-size-22px">
                <p>Redemptions will be available daily, but we’ll need a break between 11.30am - 12.30pm to update more rewards!</p>
            </div>
        </div>
    </div>

    <div class="row block-2-row-1-margin">
        <div class="offset-lg-3 col-lg-6">
            <div class="font-NunitoSans-ExtraBold font-size-35px">
                <span>Do my coins have an expiration date?</span>
            </div>
        </div>
        <div class="offset-lg-3 col-lg-6 mt-3">
            <div class="font-NunitoSans-SemiBold font-size-22px">
                <p>No, they don’t! However, it is important to take note that the OnzLAH! Coins earned are not transferable.</p>
            </div>
        </div>
    </div>

</div>

<!------------------------------------------------ 3rd block end / 4th block start  -------------------------------------------->

<div id="signup-now" class="container-fluid bg-lime padding-top-50rem">
    <div class="row">
        <div class="offset-lg-3 col-lg-6 text-center mb-5">
            <div class="font-Montserrat-Bold font-size-42px">
                <span class="bg-violet text-white px-3"> SIGN UP NOW </span>
            </div>
        </div>
        <div class="offset-lg-3"></div>
        <div class="offset-lg-3 col-lg-6 mb-5">
            <div class="font-NunitoSans-SemiBold font-size-28px text-center">
                <span>Register your OnzLAH! account now before we launch it in App Store and Play Store, and you will receive 10,000 coins and 20 extra lives as pre-launch registration bonus!</span>
            </div>
        </div>
        <div class="offset-lg-4 col-lg-4 mt-3 margin-bottom-50rem" style="z-index:10;">
            <form class="needs-validation" novalidate action="/register" method="POST">
                @csrf
                <div class="form-group">
                    <div class="font-Nunito-Sans font-size-17px text-danger" id="suggested-names" style="display:none"></div>
                    <input type="text" class="form-control input-extra-size input-sharp font-Nunito-Sans font-size-17px font-color-black p-17" placeholder="Username" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control input-extra-size input-sharp font-Nunito-Sans font-size-17px font-color-black p-17" placeholder="Password (min. 8 characters)" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <div class="font-Nunito-Sans font-size-17px text-danger" id="suggested-email" style="display:none"></div>
                    <input type="email" class="form-control input-extra-size input-sharp font-Nunito-Sans font-size-17px font-color-black p-17" placeholder="Email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-extra-size input-sharp font-Nunito-Sans font-size-17px font-color-black p-17" placeholder="Phone number" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-extra-size input-sharp font-Nunito-Sans font-size-17px font-color-black p-17" placeholder="Referral code" id="referral" name="referral">
                </div>
                <div class="form-group form-check">
                    <label class="form-check-label label-checkbox font-NunitoSans-Regular font-size-20px">I have read and agree with the <span id="tnc"><u>Terms & Conditions and Privacy Policy.</u></span>
                    <input type="checkbox" class="checkbox-hide">
                    <span class="form-check-input font-Nunito-Sans checkbox-register"></span>
                    </label>
                </div>

                <input type="hidden" name="source" value="web">
                <div class='text-center py-3 px-5'>
                    <button id="submit-btn" type="submit" class="btn button-yellow font-Montserrat font-size-35px">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 p-0 mt-5">
            <img src="images/website/block-4-btmright.svg" alt="" class="img-fluid block-btmright-image">
        </div>
    </div>

    <div class="modal fade" id="tncmodal" tabindex="-1" role="dialog" aria-labelledby="nolable" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-yellow-content input-sharp tnc-scroll">
                <div class="modal-header">
                    <button type="button" class="float-right btn btn-danger" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p class="tncpp-popup-h2">1. Definitions</p>
                            <p class="tncpp-popup-content">In these Terms and Conditions “OnzLAH!” is defined as the locally produced game show by The Hot Shoe Show & Co Sdn Bhd (“Hotshoes”) where players can play games, earn coins, and redeem prizes. “Program” refers to the OnzLAH! game show. “Player” is defined as an individual register to OnzLAH! games show. “Coins” refers to the coins earned during the Program. ‘Participating Brand’ means product provider or company/persons that are engaged by Hotshoes to supply the “product”. “Platform” refers to accessing online and mobile games through web app, mobile app, and/or other platforms. “Voucher” refers to a voucher in the form of printed or electronic which can be used to redeem the specific items and/or services offered by the Participating Brand.</p>
                            <p class="tncpp-popup-h2">2. Introduction</p>
                            <p class="tncpp-popup-content">These are the terms and conditions applicable to all participants of the Program.</p>
                            <p class="tncpp-popup-content">Please read these terms and conditions (the “Terms”) carefully to ensure that you understand and agree to them, as they contain the legal terms and conditions that all participants shall be deemed to have agreed to when registering for the Program. For the avoidance of doubt, capitalized terms set and not defined herein have the same meaning as given to such terms in the Terms of Use. In the event of a conflict between the provision of these Terms and/or the Terms of Use, the provisions of these Terms shall prevail to the extent of such conflict. All participants must adhere to these Terms at all times.</p>
                            <p class="tncpp-popup-content">Any references to “we”, “us” or “our” shall be taken as references to the Program. Any references to “you” or “your” shall be taken as references to any player for the Program.</p>
                            <p class="tncpp-popup-h2">3. Eligibility</p>
                            <p class="tncpp-popup-content">When you access our Program, you will need to create an account (“Account”). Only individuals above 18 years of age may register as the Player. Individuals under 18 years of age may take part in the Program with parental or legal guardian consent. If you are under the age of 18, you represent that your parents or legal guardian has reviewed and agreed to these Terms. If you access our Program through a third party platform like Apple or Google and/or a social networking site like Facebook, you are obligated to comply with their terms of service in addition to our Terms. When you register for an account or update the information, you agree to provide us accurate information and that you will keep it up-to-date at all times. If you are under the age of 18, you may never allow anyone else to use your account except your parents or legal guardian. If you have reason to believe that our account is no longer secure, then you must immediately notify us at info@onzlah.live.</p>
                            <p class="tncpp-popup-h2">4. Your Obligations</p>
                            <p class="tncpp-popup-bullet-1 d-flex">4.1 By agreeing to these Terms, the Player:</p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">a.</span><span class="col-11 ml-neg10">comply with all applicable laws and regulations to the fullest extent when participating in the Program.</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">b.</span><span class="col-11 ml-neg10">comply with all instructions issued by OnzLAH! in relation to the Program, and you shall not as part if your participation in the Program, breach any of these terms.</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">c.</span><span class="col-11 ml-neg10">responsible for all information that you communicate, submit , transmit or otherwise make available during your participation in the Program whether to OnzLAH!.</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">d.</span><span class="col-11 ml-neg10">not participate in the Program or permit the participation in the Program in any manner which may adversely affect other customers’ participation in the Program or the goodwill or reputation of OnzLAH!</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">e.</span><span class="col-11 ml-neg10">not participate in the Program in a fraudulent manner, including but not limited to participation in the Program with more than one customer account or copying another person’s Program entry.  Each Eligible User can only participate with one customer account.</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">f.</span><span class="col-11 ml-neg10">participation in the Program shall be deemed to constitute your unconditional and irrevocable acceptance of these Terms, the Terms of Use, and any other such terms as may be notified to you by OnzLAH! from time to time.</span></p>
                            <p class="tncpp-popup-bullet-1 d-flex">4.2 Where we deem that you have breached of any these Terms, or otherwise fraudulently participated in the Program, we reserve the right to:</p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">a.</span><span class="col-11 ml-neg10">prevent or restrict access of any Player to the Program, the OnzLAH! mobile application, or any of the OnzLAH! Platforms; or</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">b.</span><span class="col-11 ml-neg10">report any activity it suspects to be in violation of any applicable law, statute or regulation to the appropriate authorities and to co-operate with such authorities.</span></p>
                            <p class="tncpp-popup-h2">5. Coins</p>
                            <p class="tncpp-popup-content">Coins will be collected when a Player plays in the Program.  Coins collected will be recorded in a Player’s account, for redemption by the Player of qualifying products or services from the Participating Brand subject always to Hotshoes’ right to appoint selected Participating Brand to offer products and/or services for the Programs.  Coins cannot be converted to cash or transferred to another player.  Coins can be used only for redemption in the Program.</p>
                            <p class="tncpp-popup-content">The Program permits the purchase of Coins and use of the Coins to redeem the products or services that we expressly make available for use in the Program.  The purchase of Coins and redemption of products or services is limited to Account holders who are either (a) 18 years of age or older; or (b) under the age of 18 and have the consent of a Parent to make the purchase.</p>
                            <p class="tncpp-popup-content">All purchases of Coins from us are final and non-refundable, except as required by applicable law.  By purchasing Coins from us, you represent and warrant that you have the authority and right to use the payment method selected by you and that such payment method has sufficient credit or funds available to complete your purchase.  If you believe someone has gained unauthorized access to your Account or used your Account without your permission, you must notify us within 30 days of the charge date by emailing us at info@onzlah.live.  We reserve the right to close any account with unauthorized charges.</p>
                            <p class="tncpp-popup-h2">6. Redemption</p>
                            <p class="tncpp-popup-content">The Player must maintain a minimum of 500 Coins in the Account.  The Player with sufficient Coins is eligible to redeem, and you may do so using the various redemption methods implemented in the Program.  Redemption orders once accepted by the Program cannot be revoked, cancelled, returned or exchanged, and the affected Coins will not be reinstated.  The Program reserves the right to decline redemptions made through any other channels without any notification. the Program gives no representation or warranty with respect to any products and/or services featured in the redemption area. In particular, the Program gives no warranty with respect to the quality of the products and/or services or their suitability for any purpose.  However, Player may liaise directly with the Participating Brand according to the redeemed item guideline.</p>
                            <p class="tncpp-popup-content">Certain products, which are in the form of Voucher, are valid for use only at Participating Brand.  The Voucher is valid for use until the date specified and subject to the Terms and Conditions (which includes booking requirements, cancellation restrictions, warranties and limitations of liability) therein. If Voucher remains unused after the date specified, the Voucher will lapse and will not be replaced. Cancellation of Voucher will not be accepted to allow reinstatement of Coins. The Voucher is not refundable or exchangeable for cash.  In the event that Voucher is in the form of cash vouchers, the recipient will have to bear the difference if purchase of products or services exceeds the Voucher face value. If the purchase amount is less than the Voucher value, the difference will not be paid out to the Player.</p>
                            <p class="tncpp-popup-content">Issuance of dining, travel, event or hotel accommodation Voucher does not constitute a reservation. The Player is responsible for notifying and making all reservations.  The Program does not accept liability whatsoever (including negligence) with respect to the products supplied or in connection with any Participating Brand’s refusal to accept Vouchers issued by Hotshoes for the purpose of redeeming product.  Any disputes’ arising from this is solely between the Player and Participating Brand.</p>
                            <p class="tncpp-popup-h2">7. Deduction of Coins</p>
                            <p class="tncpp-popup-content mb-0">The number of Coins published for the product and/or service claimed by a Player will be deducted from the Coin balance of the Player’s account.  Hotshoes may also deduct from the Coin balance in a Player’s account, given the following circumstances: -</p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">a.</span><span class="col-11 ml-neg10">Any Coins suspected to be fraudulently recorded; or</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">b.</span><span class="col-11 ml-neg10">Any Coins recorded in error; or</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">c.</span><span class="col-11 ml-neg10">Any Coins relating to a transaction which is cancelled</span></p>
                            <p class="tncpp-popup-content">Hotshoes reserves the right to deduct any such Coins as stated above without notifying the Player.</p>
                            <p class="tncpp-popup-h2">8. Privacy Policy</p>
                            <p class="tncpp-popup-content">We are under an obligation to protect the confidentiality, integrity and accessibility of your data, including personal data. Protecting personal data is essential to us, and we are continuously working on ensuring compliance with applicable data protection legislation, including the Personal Data Protection Act (“PDPA”).</p>
                            <p class="tncpp-popup-content mb-0">As a data subject, you have certain rights pursuant to the PDPA. Your rights may be summarised as follows:</p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">a.</span><span class="col-11 ml-neg10">The right of access by the data subject. You have the right to gain access to the personal data concerning you that we process.</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">b.</span><span class="col-11 ml-neg10">The right to have incorrect personal data rectified. You have the right to have incorrect personal data about yourself rectified without undue delay.</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">c.</span><span class="col-11 ml-neg10">The right to have personal data erased. You have the right to have your personal data erased at an earlier point in time than when our ordinary erasure takes place, where appropriate.</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">d.</span><span class="col-11 ml-neg10">The right to restriction of data processing. You have the right to restrict our processing of your personal data, where appropriate. In such cases, we may only process your data with your consent or in some very specific situations as outlined in PDPA.</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">e.</span><span class="col-11 ml-neg10">The right to object to personal data processing. In such cases, we may only process your personal data if we are able to demonstrate compelling legitimate grounds for doing so.</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg15">f.</span><span class="col-11 ml-neg10">The right to data portability. You have the right to receive your personal data in a structured, commonly used and machine-readable format. You may also request that we transmit your personal data to another data controller without hindrance.</span></p>
                            <p class="tncpp-popup-content">When we process personal data based on your consent, you have the right to withdraw your consent at any time. Please contact us to withdraw consent for our processing of your personal data.</p>
                            <p class="tncpp-popup-content">We acknowledge that transparency is an ongoing responsibility. Therefore, we will continually review and update this data protection policy in order to ensure our compliance with applicable personal data law from time to time.</p>
                            <p class="tncpp-popup-content">Please contact us at info@onzlah.live if you would like to exercise your rights as described above, or if you have questions about our processing of your personal data or this data protection policy.</p>
                            <p class="tncpp-popup-content">If you wish to complain about our processing of personal data, please send an email with the details of your complaint to info@onzlah.live. We will handle your complaint and get back to you.</p>
                            <p class="tncpp-popup-h2">9. Limitation of Liability and Release</p>
                            <p class="tncpp-popup-content">The Player acknowledges and agrees that:</p>
                            <p class="tncpp-popup-bullet-1 d-flex"><span class="col-1 ml-neg15">9.1</span><span class="col-11">Hotshoes shall not be responsible to you for any loss, damage, fine, regulatory action, claim or compensation of whatever nature arising from or related to the Program (Liabilities”) including but not limited to (i) your breach of these Terms, (ii) any alleged unauthorized transactions, disruptions, errors, defects or unavailability of the Program. Or (iii) any loss of data or damage to any of your mobile equipment, to the fullest extent permitted by applicable law. In the event that any Liabilities are not excluded by the foregoing in this Clause 9.1, OnzLAH!’s, maximum aggregate liability to you in respect of such Liabilities, whether under all applicable laws of contract, tort or otherwise, shall be MYR100 (or the equivalent value of such amount in the currency of your jurisdiction), to the fullest extent permitted by applicable law.</span></p>
                            <p class="tncpp-popup-bullet-1 d-flex"><span class="col-1 ml-neg15">9.2</span><span class="col-11">Hotshoes does not make any warranty or representation or undertaking on the performance and capability of the Platform, the Program and/or any software or hardware the Program, or the reliability or quality of the underlying telecommunication network accessed by you using the Program.</span></p>
                            <p class="tncpp-popup-h2">10. Governing Law</p>
                            <p class="tncpp-popup-content">These Terms are governed by the law in force in Malaysia. All legal actions in connection with these Terms shall be bought in the state or federal courts located in Malaysia.</p>
                            <p class="tncpp-popup-h2">11. Miscellaneous</p>
                            <p class="tncpp-popup-bullet-1 d-flex"><span class="col-1 ml-neg15">11.1</span><span class="col-11 ml-5px">Hotshoes reserve the sole right to alter, modify, add to or otherwise vary these Terms from time to time, and in such manner as Hotshoes deems appropriate.  In the event of variation of these Terms, if you continue to participate in the Program thereafter, you shall be bound by the Terms as so amended and shall be deemed to have accepted the Terms as so amended.</span></p>
                            <p class="tncpp-popup-bullet-1 d-flex"><span class="col-1 ml-neg15">11.2</span><span class="col-11 ml-5px">You may not use any technological or other means (such as by cheating or using bugs or glitches in the Program, or by using third party tools or software) to use the Program in a way that is not within the spirit of fair play or these Terms.  You specifically agree that you will not</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg5px">a.</span><span class="col-11 ml-neg10">Use the Program for fraudulent or abusive purposes (including, without limitation, by using the Program to impersonate any person or entity, or otherwise misrepresent our affiliation with a person, entity or our Program);</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg5px">b.</span><span class="col-11 ml-neg10">Disguise, anonymize or hide your IP address or the source of any content that you may upload;</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg5px">c.</span><span class="col-11 ml-neg10">Interfere with or disrupt the Program or serves or networks that provide the Program;</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg5px">d.</span><span class="col-11 ml-neg10">Attempt to decompile, reverse engineer, disassemble or hack any of the Program, or to defeat or overcome any of the encryption technologies or security measures or data transmitted, processes or stored by us;</span></p>
                            <p class="tncpp-popup-bullet-2 d-flex"><span class="col-1 ml-neg5px">e.</span><span class="col-11 ml-neg10">Do anything else that is not within the spirit of fair play or the Terms.</span></p>
                            <p class="tncpp-popup-bullet-1 d-flex"><span class="col-1 ml-neg15">11.3</span><span class="col-11 ml-5px">The Program may contain links to third party websites or resources.  We provide these links only as a convenience and are not responsible for the content, products, or services on or available from those websites or resources or links displayed on such websites.  You acknowledge sole responsibility for and assume all risk arising from, your use of any third party websites or resources.</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------ 4th block end / footer start     -------------------------------------------->

<div class="container-fluid bg-violet text-white padding-y-50rem">
    <div class="row">
        <div class="offset-xl-3 col-xl-2 col-lg-4 offset-md-1 col-md-4 offset-sm-2 col-sm-8 offset-2 col-8">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 my-3">
                        <span class="font-Montserrat-ExtraBold font-size-25px">
                            Follow Us
                        </span>
                    </div>
                    <div class="col-12 my-3">
                        <a href="https://www.facebook.com/onzlah.live/">
                            <img src="images/website/footer-icon-fb.svg" class="img mr-3">
                            <span class="font-Montserrat-Bold font-size-22px text-white">Facebook</span>
                        </a>
                    </div>
                    <div class="col-12 my-3">
                        <a href="https://www.instagram.com/onzlah.live/">
                            <img src="images/website/footer-icon-ig.svg" class="img mr-3">
                            <span class="font-Montserrat-Bold font-size-22px text-white">Instagram</span>
                        </a>
                    </div>
                    <div class="col-12 my-3">
                        <a href="https://www.youtube.com/channel/UCBSbnWxsEn2ZbNQj4YCcRsA">
                            <img src="images/website/footer-icon-youtube.svg" class="img mr-3">
                            <span class="font-Montserrat-Bold font-size-22px text-white">Youtube</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 offset-sm-2 col-sm-8 offset-2 col-8">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-5 mb-3">
                        <a href="/website-partner" class="font-Montserrat-Bold font-size-22px text-white">
                            Be Our Partner
                        </a>
                    </div>
                    <div class="col-12 my-3">
                        <span class="font-Montserrat-Bold font-size-22px">
                            Privacy Policy and Terms & Conditions
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('postscript')
    <script>
        $(document).ready(()=>{
            @if ($errors->any())

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })


                @foreach ($errors->all() as $error)
                    Toast.fire({
                        icon: 'error',
                        title: '{{ $error }}'
                    })
                @endforeach
            @endif

            @if(Session::has('success'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{Session::get("success")}}'
            })
            @endif

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#tnc').on('click',(e)=>{
                e.preventDefault();
                $('#tncmodal').modal('toggle');
            });

            $('#submit-btn').on('click',()=>{
                if($('#username').val() == ''){

                }
            });

            var timeout_name = null;
            $('#username').on('keyup', function(){
                $('#suggested-names').fadeOut();
                clearTimeout(timeout_name);
                if ($('#username').val() != ''){
                    timeout_name = setTimeout(function() {
                        $.ajax({
                            url: "{{ url('/register-check') }}",
                            method: 'post',
                            data: {
                                'type' : 'username',
                                "name" : $('#username').val(),
                            },
                            success: function (response) {
                                if (response.status == 'available'){
                                    $('#suggested-names')
                                        .html('Username available')
                                        .addClass('text-success')
                                        .removeClass('text-danger')
                                        .fadeIn();
                                }
                                else if (response.status == 'unavailable'){
                                    console.log(response.names);
                                    $('#suggested-names').html('Username unavailable')
                                        .addClass('text-danger')
                                        .removeClass('text-success')
                                        .fadeIn();
                                }
                            }
                        });

                    }, 500)
                }

            });

            var timeout_email = null;
            $('#email').on('keyup', function(){
                $('#suggested-email').fadeOut();
                clearTimeout(timeout_email);
                if ($('#email').val() != ''){
                    timeout_email = setTimeout(function() {
                        $.ajax({
                            url: "{{ url('/register-check') }}",
                            method: 'post',
                            data: {
                                "type" : 'email',
                                "email" : $('#email').val(),
                            },
                            success: function (response) {
                                if (response.status == 'available'){
                                    $('#suggested-email')
                                        .html('Email available')
                                        .addClass('text-success')
                                        .removeClass('text-danger')
                                        .fadeIn();
                                }
                                else if (response.status == 'unavailable'){
                                    $('#suggested-email')
                                        .html('Email unavailable')
                                        .addClass('text-danger')
                                        .removeClass('text-success')
                                        .fadeIn();
                                }
                            }
                        });

                    }, 500)
                }

            })
        })
    </script>
@endsection
