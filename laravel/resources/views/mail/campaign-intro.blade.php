@component('mail::message')

# Hello {{ucfirst( $creator->channel_name )}},
<br>

<p>We want to hire you at $1000+ per month.</p>
<br>

<h2>What we do</h2>

<p>We are a a startup based in New York and opperating in the subscription box industry.  We are working with creators to sell subscription boxes to their fans. Fans may subscribe to receive said boxes every month, two months, or three months.</p>

<p>We have many suppliers with whom we work, so; we can acquire a range of products to satisfy any demographic. </p>

<p>We also handle the warehousing, shipping, and packaging of boxes. </p>

<h2>Your role</h2>
    
<p>You will be responsible for communicating with your viewers and driving them to subscribe. Both you and
    Boxeon will decide what goes into every box.
</p>

<h2>Your pay</h2>

<p>As far as pay is concerned, our standard offer is this:
</p>
<ol>
<li>$1000 per month with a 12 month contract</li>
<li>$5 per month per box sold</li>

</ol>
<p>The above offer comes with a 90-day probationary period.</p>


<h2>A suggestion</h2>

<p>We suggest you offer your fans a subscription box of Ukraine-made daily essential products. Boxeon will donate part of its proceeds to Ukraine relief efforts.
    This will be great for your brand.
</p>
<h2>Next step</h2>
<p>We're hosting group meetings with creators via Google Meet to dicuss further. Our next meeting is Friday at 2pm EST. If interested, please
    let us know.
</p>

<br><br>

Sincerely,<br>
Trevor Prime, CEO<br>
https://boxeon.com<br>
E: trevor@boxeon.com<br>
P: +1.646.450.4671‬‬
<br><br>
<p><a target='_blank' href='https://boxeon.com/mail/unsubscribe?e={{$creator->email}}'>Unsubscribe</a> from future emails.</p>
@endcomponent
