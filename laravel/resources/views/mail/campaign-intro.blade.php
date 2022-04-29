@component('mail::message')

# Hello {{ucfirst( $creator->channel_name )}},
<br>

<p>We want to hire you at $1000 per month.</p>
<br>

<h2>What we do</h2>

<p>Boxeon is a remote job for content creators. We are a startup based in New York, opperating in the subscription box industry.  We are hiring creators to sell subscription boxes to their fans.</p>

<p>We have many suppliers with whom we work, so; we can acquire a range of products to satisfy any demographic. </p>

<p>We also handle the warehousing, shipping, and packaging of boxes. </p>
<p>Presently, we're seaking to hire <b>ten</p> creators to be a part of our beta launch.</p>

<h2>Creator's role</h2>
    
<p>Creators will promote their subscription box in the same fashion creators promote their Patreon.</p>
<p>Both the creator and Boxeon will decide what goes into every box.
</p>

<h2>Creator's pay</h2>

<p>As far as pay is concerned, our standard offer is this:
</p>
<ul>
<li>$1000 per month with a 12 month contract</li>
</ul>
<p>The above offer comes with a 90-day probationary period.</p>


<h2>What can you put in a box?</h2>

<p>As mentioned earlier, we work with various suppliers so we can curate boxes to satisfy almost any demographic.  For example: if you wanted to do a subscription box of Ukraine-made daily essential products in support of Ukraine refugee relief efforts,
    we can make that happen.
</p>
<h2>Next step</h2>
<p>We're hosting weekly Friday meetings at 2pm EST via Google Meet to discuss further. If you'd like to attend a meeting please let us know.
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
