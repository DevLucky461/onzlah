@component('mail::message')
# Your Registration is Successful!

Thank you for registering with us on OnzLAH!<br>
# Please follow these steps to log into our web application.<br>

<p><b><u style="color: black">Step 1</u></b>: Click <a href="https://www.onzlah.live/login"><u><b style="color: black">HERE</u></b></a> to log in.</p>
<p><b><u style="color: black">Step 2</u></b>: Enter your login details to proceed.</p>
<img src="https://onzlah.live/images/mail/login_cred.PNG" class="small-logo" alt="Onzlah Logo" style="width: auto; height: auto;margin-bottom: 2.5rem">
<p><b><u style="color: black">Step 3</u></b>: Enter your 6-digit code when prompted with the verification page. <span style="font-size: 30px; color:black">Your code is : <b>{{$data}}</b></span></p>
<img src="https://onzlah.live/images/mail/validation.PNG" class="small-logo" alt="Onzlah Logo" style="width: auto; height: auto;margin-bottom: 2.5rem">
<p><b><u style="color: black">Step 4</u></b>: Congratulations ! You’re now logged into OnzLAH! <b style="color: black">Get extra 5000 coins</b> by updating and completing your details in the Profile Page.</p>
<img src="https://onzlah.live/images/mail/profile-1.png" class="small-logo" alt="Onzlah Logo" style="width: auto; height: auto;margin-bottom: 2.5rem">
<img src="https://onzlah.live/images/mail/profile-2.png" class="small-logo" alt="Onzlah Logo" style="width: auto; height: auto;margin-bottom: 2.5rem">

# See you there!<br>

Sincerely,
OnzLAH! Team
@endcomponent
