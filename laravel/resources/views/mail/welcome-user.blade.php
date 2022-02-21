@component('mail::message')
<img src="https://boxeon.com/assets/images/high-five.png">

# <h2>{{$user->given_name}}, welcome to {{ config('app.name') }}!</h2>


 <p>You have sucessfully created an account on Boxeon. Congratulations on being an early adopter. We are here to answer your questions if you have any.</p>

 <p>Please add our email address to your address book to avoid missing important updates.</p>

<h2>If you want to create a subscription box:</h2>

@component('mail::button', ['url' => 'https://boxeon.com/box/create'])
Start here
@endcomponent

<h2>Or, if you're looking for your favorite creator:</h2>
@component('mail::button', ['url' => 'https://boxeon.com/search/creator'])
Start here
@endcomponent

Thanks you,<br>
- The {{ config('app.name') }} Team
@endcomponent
