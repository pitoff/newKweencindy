@component('mail::message')
# Accepted

{{$msg}}.

@component('mail::button', ['url' => ''])
View Booking
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
