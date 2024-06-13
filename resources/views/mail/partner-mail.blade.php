@component('mail::message')
# Verification Mail

Someone has sent request to become our partner!<br>
Details is as follow:<br>

Name: {{$name}}<br>
Company: {{$company}}<br>
Position: {{$position}}<br>
Email: {{$email}}<br>
Contact Number: {{$contact}}<br>

Sincerely,
onzlah Team
@endcomponent
