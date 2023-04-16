@component('mail::message')
# Hello {{ $user->username }}!

{{ $text }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
