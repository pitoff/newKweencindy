@component('mail::message')
# New booking

@component('mail::panel')
{{ $msg }}

{{-- State: **{{$state ?? $nil}}**

Town: **{{$town ?? $nil }}**

Address: **{{$addr ?? $nil }}**

Location: **{{$location}}**

Date: **{{$date}}** --}}

@component('mail::table')
| Details  |   Values               |
| :-------- | ----------------------: |
| State    | **{{$state ?? $nil}}** |
| Town     | **{{$town ?? $nil }}** |
| Address  | **{{$addr ?? $nil }}** |
| Location | **{{$location}}**      |
| Date     | **{{$date}}**          |
@endcomponent

@endcomponent

@component('mail::button', ['url' => ''])
View Booking
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
