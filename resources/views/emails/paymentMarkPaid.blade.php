@component('mail::message')
# Payment status please user text msg does not show

{{ $message }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
