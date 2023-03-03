@component('mail::message')
# Payment not Confirmed

{{ $message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
