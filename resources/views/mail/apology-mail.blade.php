@component('mail::message')
# Your Registration is Successful!

Thank you for registering with us on OnzLAH!<br>

Due to a system maintenance, we are required to reset your username and password to a predefined one.

Your default details are as follows:

Username: <b>{{$data['name']}}</b> <br>
Password: <b>{{$data['password']}}</b> <br>

<p>Click <a href="https://www.onzlah.live/login"><u><b style="color: black">HERE</u></b></a> to log in.</p>

You may change your password to a preferred one under<br> 
Profile > Edit Password menu.

Should you wish to change your username to a new one, you can send us an email with your details and we will update your account accordingly.

Sincerely,
OnzLAH! Team
@endcomponent
