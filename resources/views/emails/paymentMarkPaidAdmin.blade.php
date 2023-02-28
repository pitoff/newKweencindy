@component('mail::message')
# Payment status

{{ $msg }}

@component('mail::button', ['url' => ''])
View Booking
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
