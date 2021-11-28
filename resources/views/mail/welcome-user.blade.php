@component('mail::message')
# Welcome To {{ config('app.name') }}

We are happy to have you {{ $user['name'] }} onboard.

if you are seller?
@component('mail::button', ['url' => 'http://localhost:8000/box'])
Get Started here
@endcomponent

if you are buyer?
@component('mail::button', ['url' => 'http://localhost:8000/'])
Get Started here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
