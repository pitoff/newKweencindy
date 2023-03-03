@component('mail::message')
# Payment Confirmation

{{$message}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
