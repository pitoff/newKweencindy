@component('mail::message')
# Booking

You have booked for {{$state}} and {{$addr}}.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
