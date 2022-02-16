@component('mail::message')

Hi {{$user->given_name}}!

You have sucessfully subscribed to your favorite creator. 
Congratulations on being an early adopter of the next big thing. 

An email with a receipt was sent to you by our payment processor.

Please save our email in your address book to ensure our shipping 
and billing updates don't end up in your spam folder.



Sincerely,<br>
- The {{ config('app.name') }} Team
@endcomponent
