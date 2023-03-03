@component('mail::message')
# Payment status

{{ $message }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
