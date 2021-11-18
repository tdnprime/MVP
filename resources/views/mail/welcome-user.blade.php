@component('mail::message')
# Welcome To {{ config('app.name') }}

We are happy to have you {{ $user['name'] }} onboard.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
