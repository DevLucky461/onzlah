@extends('layouts.app')

@section('prescript')

@endsection

@section('content')
    <div class="container-fluid scroller">
        <div class="row main-header-bg pt-5 bg-violet">
            <div class="col-1 text-left pt-2">
                <a href="/profile"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a>
            </div>
            <div class="col-11 text-center">
                <p class="font-Montserrat-ExtraBold font-size-28px FFEF41-color ">FAQS</p>
            </div>
        </div>


        <div id="faq-start" class="row">

            <div class="col-12">
                <p class="font-Nunito-Sans font-size-16px mt-4">Everything you need to know so you can OnzLAH! like a pro.</p>
            </div>

            <div class="col-12">
                <h2 class="font-Montserrat font-size-24px mb-0 mt-4">My Profile</h2>
                <div class="text-left mb-3">
                    <hr class="hr-pink w-50">
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">How do I deactivate my account?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">You won’t be able to deactivate/delete your OnzLAH! Account. You may simply not use your account if you no longer want or are able to play on OnzLAH!</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">I forgot my username/password, what should I do?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Step 1: Fill in your email at the login page and click on “Forgot Username/Password”.</p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Step 2: Fill up your email and click the “Send” button.</p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">You will receive confirmation email to reset your password.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">How can I change/update the information in my profile?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Go to the profile tab at the menu bar bottom right and you may change/update your information accordingly.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">Why did I not receive my verification code?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Make sure you have keyed in the correct email.</p>
                </div>
            </div>

            <div class="col-12">
                <h2 class="font-Montserrat font-size-24px mb-0 mt-4">Coins</h2>
                <div class="text-left mb-3">
                    <hr class="hr-green w-50">
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">Do coins expire?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">There is no expiration date for the coins.</p>
                </div>
            </div>

            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">Where can I check my coins balance?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">You may check your coins balance at your profile page.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">How to earn coins?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Play the game, ensure you make it to the final question and find out if you are among the lucky ones! Coins will be split evenly among the winners and auto debited to your account after the game ends.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">How do I exchange coins for Host Gift?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Step 1 : During the live, click on “Gift” to see all stickers under Gift.</p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Step 2 : Choose your favorite stickers, check on many coins you can exchange it for.</p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Step 3 : Click “Send”.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">How to use coins that you have collected?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">You can use the coins you have collected to redeem exciting rewards from the redeem tab at the bottom menu bar.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">Can I change my coins to cash/ transfer to another account?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">No, Coins cannot be converted to cash or transferred to another player.</p>
                </div>
            </div>
            
            <div class="col-12">
                <h2 class="font-Montserrat font-size-24px mb-0 mt-4">Referral Code</h2>
                <div class="text-left mb-3">
                    <hr class="hr-yellow w-50">
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">Do lives expire?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Accrued lives will never expire.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">Where can I check my lives balance?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">You may check your remaining lives at your profile page.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">Can I exchange my live to coins / transfer to another account?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Life is not exchangeable for coins and transferrable to other accounts.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">What is the point for “lives”?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Lives can be used for you to continue playing the game when you answered wrongly.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">How to use live that you have collected?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">You can use them maximum 3 times per event, used right after each question that you answered wrongly.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">What is the maximum number of life I can have?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">There is no maximum number of life when you play OnzLAH!.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">What is the purpose of referral code?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Purpose of the referral code is to introduce your friends and families to this app, and let them register their account using your referral codes. You will get 1 life for each account referenced using your referral code.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">How do I use my referral code?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Go to your profile and click on “My Referral Code”.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">Where can I get my referral code?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Tap on profile > My referral code > Copy > Send it to your friend.</p>
                </div>
            </div>
            
            <div class="col-12">
                <h2 class="font-Montserrat font-size-24px mb-0 mt-4">Engagements</h2>
                <div class="text-left mb-3">
                    <hr class="hr-orange w-50">
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">What is the leaderboard for?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">A leaderboard on which the scores of the leading competitors are displayed.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">How do I check the leaderboard?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Go to home page and click on the trophy icon on top.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">Whats the purpose of the leaderboard?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">To allow you to see your friend’s progress and to promote competitiveness. You can only see accounts that you have added as friends on the leaderboard.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">What is the scan button for?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">You can use the scan button to add friends, as an alternative to the search friend function.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">How can I contact OnzLAH?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">You may contact OnzLAH! by:</p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">*E-mail to info@onzlah.live</p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">*Drop us a message via https://www.facebook.com/OnzLAH.live</p>
                </div>
            </div>
            
            <div class="col-12">
                <h2 class="font-Montserrat font-size-24px mb-0 mt-4">Redemption</h2>
                <div class="text-left mb-3">
                    <hr class="hr-blue w-50">
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">How do I view my redeemed rewards?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">You may view your rewards when you click “My Redeems” at your Redeem Page.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">I accidentally redeem duplicate rewards. What should I do?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">You may email to info@onzlah.live to cancel the duplicated rewards.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">How do I know if a product (rewards) is still available?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">There will be an indicator on the Reward page on the remaining reward count.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">What if the rewards I've received appear to be different from the description?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">We select image that we hope most accurately reflect the color and shape of products alongside the product specification, but, depending on your screen resolution, or the manufacturer that supplies the product there may be small variations in colour, such as a slightly lightly shaded between the actual product and how it appear when viewed on the website.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">Do the rewards have an expiry date?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">You may check the reward’s expiry date by going to the My Reward section on the Reward tab. Each of the reward’s expiry date is recorded in the details.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">If my reward expires, can I refund/exchange coins or extend my reward period?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">If your reward is expired,  it will not be refunded / exchanged / extended and replaced.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">Can I cancel the reward redemption or exchange for another reward after redemption is confirmed?</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">Redemption cannot be cancelled, exchanged or refunded.</p>
                </div>
            </div>
            
            <div class="col-12 mb-2 mt-1 pb-40px">
                <div class="faq-drop py-2 px-3">
                    <p class="font-NunitoSans-SemiBold font-size-16px jsFaqDrop mb-0 d-flex">
                        <span class="col-11 pl-0 font-Montserrat-Bold">Is there a limit to the number of reward redemption? (grab)</span>
                        <i class="col-1 px-0 fa fa-angle-down fa-lg pull-right jsFaqIcon" aria-hidden="true"></i>
                    </p>
                    <p class="font-Nunito-Sans font-size-16px text-left faq-desc jsFaqDesc" style="display:none;">There is no limit to reward redemption subject to availability. However each redemption must be made separately.</p>
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
    
    $(document).ready(()=>{

        $('#faq-start').on('click', '.jsFaqDrop', (e)=>{
            $(e.currentTarget).find('.jsFaqIcon').toggleClass('fa-angle-down fa-angle-up');
            $(e.currentTarget).siblings($('.jsFaqDesc')).slideToggle();
        })

    })
</script>
@endsection
@endsection
