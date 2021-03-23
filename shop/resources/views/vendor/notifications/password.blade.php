<?$url = asset('/password/reset').'/'.$token.'?email='.$email?>
@component('mail::message')

# Hello,

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

This password reset link will expire in 60 minutes.

If you did not request a password reset, no further action is required.

Regards,{{ config('app.name') }}
<hr>    
If you’re having trouble clicking the "Reset Password" button, copy and paste the URL
below into your web browser:

<a style = "max-width:600px" href="{{$url}}">
    {{asset('/password/reset').'/'}}
    <br>   
    {{$token}}
    <br>
    ?email=
    {{$email}}
</a>

TE905
@endcomponent
