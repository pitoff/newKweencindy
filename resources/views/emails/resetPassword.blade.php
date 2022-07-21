@component('mail::message')
# Password-Reset

Please, Click on the link provided below to reset password. <br>Link expires in 5 minutes.

@component('mail::button', ['url' => route('reset-password', $passwordToken)])
Click here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
