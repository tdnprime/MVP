@component('mail::message')

# Welcome To {{ config('app.name') }}

Thank you for joining Boxeon.

You have sucessfully created an account on Boxeon. Congratulations on being an early adopter. We are here to answer your questions if you have any.

<h2>If you want to create a subscription box...</h2>
@component('mail::button', ['url' => 'https://boxeon.com/box/create'])
Get Started here
@endcomponent

Or, if you're looking for your favorite creator...
@component('mail::button', ['url' => 'https://boxeon.com/search/creator'])
Get Started here
@endcomponent

Thanks you,<br>
- The {{ config('app.name') }} Team
@endcomponent
