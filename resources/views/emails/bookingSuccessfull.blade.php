@component('mail::message')
# Booking Details

@component('mail::panel')
{{ $msg }}

@component('mail::table')
| State              | Town               | Address            | Location           | Date               |
| ------------------ |:------------------:|:------------------:|:------------------:| ------------------:|
| {{$state ?? $nil}} | {{$town ?? $nil }} | {{$addr ?? $nil }} | {{$location}}      | {{$date}}          |
@endcomponent

@endcomponent

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent