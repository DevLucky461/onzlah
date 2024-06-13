@extends('layouts.app')

@section('prescript')


@endsection

@section('content')



@if(session()->has('created'))
<script>
    Swal.fire({
        title: 'success!',
        text: 'We received your feedback, Thank You',
        icon: 'success',
        confirmButtonText: 'Yes'
    })
</script>
@endif

<div class="container-fluid scroller pl-0 pr-0">
    <div class="container-fluid main-header-bg">
        <div class="row" style="padding-top:5rem">
            <div class="col-2 text-left  flex-center pl-0">
                <a href="/profile"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a>
            </div>
            <div class="col-10 text-center">
                <p class="font-Montserrat-ExtraBold font-size-25px FFEF41-color mb-0">TERMS & CONDITIONS</p>
            </div>
        </div>
    </div>
</div>
<div id="tncpp-popup" class="tncpp-popup">
    <div class="container-fluid scroller bg-yellow-content p-35 border-black-2px font-color-black">
        <div class="row">
            <div class="col-12">
            <a href="/profile"><button id="tncpp-close-1" class='btn btn-exit input-sharp float-right'><img src="{{url('images/close-icon.svg')}}"></button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="tncpp-popup-h1 font-Montserrat-Bold font-size-24px mb-20 mt-20">Terms and Conditions of Participation</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="tncpp-popup-h2">1. Definitions</p>
                <p class="tncpp-popup-content">In these Terms and Conditions “OnzLAH!” is defined as the locally produced game show by The Hot Shoe Show & Co Sdn Bhd (“Hotshoes”) where players can play games, earn coins, and redeem prizes.  “Program” refers to the OnzLAH! game show.  “Player” is defined as an individual register to OnzLAH! games show.  “Coins” refers to the coins earned during the Program.  ‘Participating Brand’ means product provider or company/persons that are engaged by Hotshoes to supply the “product”.  “Platform” refers to accessing online and mobile games through web app, mobile app, and/or other platforms.  “Voucher” refers to a voucher in the form of printed or electronic which can be used to redeem the specific items and/or services offered by the Participating Brand.</p>
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
                <p class="tncpp-popup-h2">5. Coins</p>
                <p class="tncpp-popup-content">Coins will be collected when a Player plays in the Program.  Coins collected will be recorded in a Player’s account, for redemption by the Player of qualifying products or services from the Participating Brand subject always to Hotshoes’ right to appoint selected Participating Brand to offer products and/or services for the Programs.  Coins cannot be converted to cash or transferred to another player.  Coins can be used only for redemption in the Program.</p>
                <p class="tncpp-popup-content">The Program permits the purchase of Coins and use of the Coins to redeem the products or services that we expressly make available for use in the Program.  The purchase of Coins and redemption of products or services is limited to Account holders who are either (a) 18 years of age or older; or (b) under the age of 18 and have the consent of a Parent to make the purchase.</p>
                <p class="tncpp-popup-content color-red">All purchases of Coins from us are final and non-refundable, except as required by applicable law.  By purchasing Coins from us, you represent and warrant that you have the authority and right to use the payment method selected by you and that such payment method has sufficient credit or funds available to complete your purchase.  If you believe someone has gained unauthorized access to your Account or used your Account without your permission, you must notify us within 30 days of the charge date by emailing us at info@onzlah.live.  We reserve the right to close any account with unauthorized charges.</p>
                <p class="tncpp-popup-content">Coins will be collected when a Player plays in the Program.  Coins collected will be recorded in a Player’s account, for redemption by the Player of qualifying products or services from the Participating Brand subject always to Hotshoes’ right to appoint selected Participating Brand to offer products and/or services for the Programs.  Coins cannot be converted to cash or transferred to another player.  Coins can be used only for redemption in the Program.</p>
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
                <p class="tncpp-popup-bullet-1 d-flex"><span class="col-1 ml-neg15">9.1</span><span class="col-11">The Program shall not be responsible to you for any loss, damage, fne, regulatory action, claim or compensation of whatever nature arising from or related to the Program (Liabilities”) including but not limited to (i) your breach of these Terms, (ii) any alleged unauthorised transactions, disruptions, errors, defects or unavailability of the Program. Or (iii) any loss of data or damage to any of your mobile equipment, to the fullest extent permitted by applicable law. In the event that any Liabilities are not excluded by the foregoing in this Clause 9.1, OnzLAH!’s, maximum aggregate liability to you in respect of such Liabilities, whether under all applicable laws of contract, tort or otherwise, shall be MYR100 (or the equivalent value of such amount in the currency of your jurisdiction), to the fullest extent permitted by applicable law.</span></p>
                <p class="tncpp-popup-bullet-1 d-flex"><span class="col-1 ml-neg15">9.2</span><span class="col-11">The Program does not make any warranty or representation or undertaking on the performance and capability of the Platform, the Program and/or any software or hardware the Program, or the reliability or quality of the underlying telecommunication network accessed by you using the Program.</span></p>
                <p class="tncpp-popup-h2">10. Governing Law</p>
                <p class="tncpp-popup-content">These Terms are governed by the law in force in Malaysia. All legal actions in connection with these Terms shall be bought in the state or federal courts located in Malaysia.</p>
                <p class="tncpp-popup-h2">11. Miscellaneous</p>
                <p class="tncpp-popup-bullet-1 d-flex"><span class="col-1 ml-neg15">11.1</span><span class="col-11 ml-5px">Hotshoes reserve the sole right to alter, modify, add to or otherwise vary these Terms from time to time, and in such manner as Hotshoes deems appropriate.  In the event of variation of these Terms, if you continue to participate in the Program thereafter, you shall be bound by the Terms as so amended and shall be deemed to have accepted the Terms as so amended.</span></p>
                <p class="tncpp-popup-bullet-1 d-flex color-red"><span class="col-1 ml-neg15">11.2</span><span class="col-11 ml-5px">You may not use any technological or other means (such as by cheating or using bugs or glitches in the Program, or by using third party tools or software) to use the Program in a way that is not within the spirit of fair play or these Terms.  You specifically agree that you will not</span></p>
                <p class="tncpp-popup-bullet-2 d-flex color-red"><span class="col-1 ml-neg5px">a.</span><span class="col-11 ml-neg10">Use the Program for fraudulent or abusive purposes (including, without limitation, by using the Program to impersonate any person or entity, or otherwise misrepresent our affiliation with a person, entity or our Program);</span></p>
                <p class="tncpp-popup-bullet-2 d-flex color-red"><span class="col-1 ml-neg5px">b.</span><span class="col-11 ml-neg10">Disguise, anonymize or hide your IP address or the source of any content that you may upload;</span></p>
                <p class="tncpp-popup-bullet-2 d-flex color-red"><span class="col-1 ml-neg5px">c.</span><span class="col-11 ml-neg10">Interfere with or disrupt the Program or serves or networks that provide the Program;</span></p>
                <p class="tncpp-popup-bullet-2 d-flex color-red"><span class="col-1 ml-neg5px">d.</span><span class="col-11 ml-neg10">Attempt to decompile, reverse engineer, disassemble or hack any of the Program, or to defeat or overcome any of the encryption technologies or security measures or data transmitted, processes or stored by us;</span></p>
                <p class="tncpp-popup-bullet-2 d-flex color-red"><span class="col-1 ml-neg5px">e.</span><span class="col-11 ml-neg10">Do anything else that is not within the spirit of fair play or the Terms.</span></p>
                <p class="tncpp-popup-bullet-1 d-flex color-red"><span class="col-1 ml-neg15">11.3</span><span class="col-11 ml-5px">The Program may contain links to third party websites or resources.  We provide these links only as a convenience and are not responsible for the content, products, or services on or available from those websites or resources or links displayed on such websites.  You acknowledge sole responsibility for and assume all risk arising from, your use of any third party websites or resources.</span></p>
            </div>
        </div>
        <div class="row mt-25 mb-25">
            <div class="col-12 text-center">
                <a href="/profile"><button id="tncpp-close-2" class='btn input-sharp btn-purple Montserrat-Bold font-size-18px'>CLOSE</button></a>
            </div>
        </div>
    </div>
</div>
@endsection
