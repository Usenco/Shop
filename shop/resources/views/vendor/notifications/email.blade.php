@component('mail::message')

# Hello,

You are receiving this email because you should to complete registration follow the link.

@component('mail::button', ['url' => $verification])
Verify Email
@endcomponent

This verify email link will expire in 60 minutes.

If you did not request a password reset, no further action is required.

Regards,{{ config('app.name') }}
<hr>    
If you’re having trouble clicking the "Verify Email" button, copy and paste the URL
below into your web browser:<br>

<a style = "max-width:600px" href="{{$verification}}">
    <?
    $tmparr ="";
    for ($i=0; $i < strlen($verification) ; $i++) { 
        $tmparr .= $verification[$i];
        if(($i+1)%70==0){
            echo $tmparr."<br>";
            $tmparr = "";
        }
    }?>
    
</a>

TE905
@endcomponent
