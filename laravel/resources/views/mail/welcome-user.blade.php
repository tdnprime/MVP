@component('mail::message')
# Welcome To {{ config('app.name') }}

We are happy to have you onboard, {{ $user['name'] }}.

if you are creator?
@component('mail::button', ['url' => 'https://boxeon.com/box/create'])
Get Started here
@endcomponent

if you are fan?
@component('mail::button', ['url' => 'https://boxeon.com/home/index'])
Get Started here
@endcomponent

Thanks,<br>
- The {{ config('app.name') }} Team
@endcomponent
