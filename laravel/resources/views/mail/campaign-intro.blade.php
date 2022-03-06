@component('mail::message')

# Hello {{ucfirst( $creator->channel_name )}}!
<br>

Our startup is seeking creators to sponsor.

But first -

Congrats on the success of your channel. Attaining {{ $creator->average_views }} average views per video takes talent. We found you on Youtube and are convinced your {{ strtolower($creator->category) }} channel is a perfect fit for us to sponsor.

We're sponsoring creators as part of the launch of our new platform.
The platform in question is boxeon.com. Boxeon allows creators to offer subscription boxes to their fans to earn sustainable, recurring income.

The sponsorship deal we're offering entails Boxeon providing the entire initial capital you'll need to launch a subscription box business on Boxeon.

If you're interested, let's schedule a 30 - 45 minute Zoom call to discuss further. Until then, keep up the great work!

<br><br>

Sincerely,<br>
Trevor Prime, CEO<br>
https://boxeon.com<br>
E: trevor@boxeon.com<br>
P:+1-‪(646) 450-4671‬

<br><br>

CONFIDENTIALITY NOTICE: This message is from Boxeon LLC and may contain confidential 
business information. It is intended solely for the use of the individual to 
whom it is addressed. If you are not the intended recipient please contact the 
sender and delete this message and any attachment from your system. 
Unauthorized publication, use, dissemination, forwarding, printing or 
copying of this E-Mail and its attachments is strictly prohibited.
<img src="https://www.google-analytics.com/collect?v=1&tid=UA-211880503-2&t=event&ec=email&ea=open"/>
@endcomponent
