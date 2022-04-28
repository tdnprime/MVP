@extends('layouts.index')
@section('title', 'Best remote job for content creators to earn monthly, sustainable income')
@section('content')

    <div id="masthead">
      <section id="headline">
        <p class="text-heading-label">BE A FREE SPIRIT WITH</p>
        <h1 class="ginormous">Liberating, flat, monthly income</h1>
        <p id="pitch">Finally, content creators can achieve the freedom they desire with a remote job offering their fans subscription boxes. Boxeon makes it a breeze - ask Marilyn.</p>
      <a class="button" href="{{ url('auth/google') }}"> Apply now </a>
        <a href="#whatis" class="button clearbtn hide"> Learn more </a> </section>
      <div id="masthead-image"> </div>
    </div>


    <main id='margin-top-45-em'> <a id='whatis' href='#whatis'></a> 
    <aside class="asides">
      <h1 class="extra-large-font darkblue">What's Boxeon?</h1>
      <p class="centered center font-1-5-em">Boxeon is a remote job for content creators and influencers. We provide you with a flat monthly income to offer a subscription box to your most loyal fans. Limited positions available.</p>
    <br></aside>
	<section class="section">
      <div class="alt-section-inner-grid">
        <div class="secinner">
          <h2 class="extra-large-font">Product curators are waiting</h2>
          <p>Boxeon's professional product curators are ready, willing, and able to
			  curate a unique experience for your fans.</p>
        </div>
        <img src="../assets/images/curators.svg" alt="Product curators" /> </div>
    </section>
    <section class="section padding-top-6-em">
      <div class="section-inner-grid"> <img src="../assets/images/hero.svg" alt='Why Boxeon'/>
        <div class="secinner">
          
          <h2 class="extra-large-font">We'll be your hero!</h2>
          <p>We pay creators a monthly salary of $1000 per month. But there is room to negotiate for more. Limited positions available.</p>
      </div>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="alt-section-inner-grid">
        <div class="secinner">
          <h2 class="extra-large-font">Ship from mars</h2>
          <p>We ship from anywhere in the universe and are experts with complicated details like address verification, customs, and more.</p>
        </div>
        <img src="../assets/images/rocket.svg" alt="Shipping" /> </div>
    </section>
    <section class="section">
      <div class="section-inner-grid"> <img src="../assets/images/winning.svg" alt="Winner"/>
        <div class="secinner">
          <h2 class="extra-large-font">Go faster</h2>
          <p>The security of having a remote job will allow you to get where you wish to go faster.</p>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="alt-section-inner-grid">
        <div class="secinner">
          <h2 class="extra-large-font">We ride together</h2>
          <p>The Boxeon team will work closely with you to ensure your subscription box is a success for both of us.</p>
        </div>
        <img src="../assets/images/car.svg" alt="Ferrari" /> </div>
    </section>
    <section class="section">
      <div class="alt-section-inner-grid"><img src="../assets/images/gdpr.svg" alt="General Data Protection Regulation" />
        <div class="secinner">
          <h2 class="extra-large-font">Secure transactions</h2>
          <p>Our financial transactions are conducted by secure services such as Square, World Remit, and CashApp.</p>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="alt-section-inner-grid">
        <div class="secinner">
          <h2 class="extra-large-font">The numbers love us</h2>
          <p>Only two YouTubers sell subscription boxes as of 2021. But there's a whopping 951k monthly Youtube searches for the phrase "subscription box." Source: TubeBuddy.</p>
        </div>
        <img src="../assets/images/love.svg" alt="Shoppers"/> </div>
    </section>
    <section class="section margin-bottom-10-em">
      <div class="alt-section-inner-grid"><img src="../assets/images/slamdunk.svg" alt="Easy business" />
        <div class="secinner">
          <h2 class="extra-large-font">Our subscription model is a slamdunk</h2>
          <p>For an idea of how Boxeon subscriptions will work from a buyers perspective, checkout Ally's <a href='https://boxeon.com/ally' class='primary-color underline one-em-font'>subscription box</a>.</p>
        </div>
      </div>
    </section>
      <br>
      <h2 class="centered">How it works</h2>
      <div id="how-it-works" class="four-col-grid">
        <div> <img src="../assets/images/computer.svg" alt="Computer"/> <h2>Survey fans</h2></div>
        <div> <img src="../assets/images/box.svg" alt="Box"/> <h2>Create box</h2></div>
        <div> <img src="../assets/images/camera.svg" alt="Camera"/> <h2>Share box</h2></div>
        <div> <img src="../assets/images/growth.svg" alt="Growth"/> <h2>Earn</h2></div>
      </div>
      <section class='section'> <br>
        <div class="centered margin-bottom-10-em">
          <h1 class="extra-large-font darkblue">It's that simple</h1>
          <br>
          <a class="button" href="{{ url('auth/google') }}"> Apply now </a> </div>
      </section>
    </main>


@endsection
