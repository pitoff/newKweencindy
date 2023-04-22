@component('mail::message')
# Booking Details

@component('mail::panel')
{{ $msg }}

@component('mail::table')
| Details  |   Values               |
| :-------- | ----------------------: |
| State    | **{{$state ?? $nil}}** |
| Town     | **{{$town ?? $nil }}** |
| Address  | **{{$addr ?? $nil }}** |
| Location | **{{$location}}**      |
| Date     | **{{$date}}**          |
| Time     | **{{$time}}**          |
@endcomponent

@endcomponent

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent