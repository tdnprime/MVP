@extends('layouts.index')

@section('content')

    <div id="masthead">
      <section id="headline">
        <p class="text-heading-label">BE A FREE SPIRIT WITH</p>
        <h1 class="ginormous">Liberating, monthly, sustainable income</h1>
        <p id="pitch">Finally, content creators can achieve the freedom they desire by offering their fans subscription boxes. Boxeon makes it a breeze - ask Marilyn.</p>
      <a class="button" href="{{ url('auth/google') }}"> Get started </a>
        <a href="#whatis" class="button clearbtn"> Learn more </a> </section>
      <div id="masthead-image"> </div>
    </div>


    <main> <a id='whatis' href='#whatis'></a> 
    <aside class="asides">
      <h1 class="extra-large-font darkblue">What's a subscription box?</h1>
      <p class="centered font-1-5-em">In this business model, content creators put together a box of products around a theme, and their most loyal fans subscribe to receive these boxes for the thematic experience. </p>
    </aside>
	<section class="section">
      <div class="alt-section-inner-grid">
        <div class="secinner">
          <h2 class="extra-large-font">Product curators are waiting</h2>
          <p>Boxeon's professional product curators are ready, willing, and able to help you
			  curate a unique experience for your fans.</p>
        </div>
        <img src="../assets/images/curators.svg" alt="Product curators" /> </div>
    </section>
    <section class="section padding-top-6-em">
      <div class="section-inner-grid"> <img src="../assets/images/hero.svg" alt='Why Boxeon'/>
        <div class="secinner">
          <h2 class="extra-large-font">Let your fans be heroes</h2>
          <p>Don't have the cash to start a subscription box? Raise the capital by using your Boxeon page to have fans pre-order.</p>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="alt-section-inner-grid">
        <div class="secinner">
          <h2 class="extra-large-font">Ship from mars</h2>
          <p>Ship from anywhere in the universe at no cost to you. We'll handle complicated details like address verification, customs, and more.</p>
        </div>
        <img src="../assets/images/rocket.svg" alt="Shipping" /> </div>
    </section>
    <section class="section">
      <div class="section-inner-grid"> <img src="../assets/images/winning.svg" alt="Winner"/>
        <div class="secinner">
          <h2 class="extra-large-font">Go faster</h2>
          <p>The profit margin on subscription boxes is 44.6% higher than the average Patreon donation, and will take you to the finish line faster.</p>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="alt-section-inner-grid">
        <div class="secinner">
          <h2 class="extra-large-font">We ride together</h2>
          <p>We have no upfront fees and your sales are subject to a simple <a href="/commission/" class="darkblue underline one-em-font">commission</a>. So where you go, we go, and we'll treat you like it.</p>
        </div>
        <img src="../assets/images/car.svg" alt="Ferrari" /> </div>
    </section>
    <section class="section">
      <div class="alt-section-inner-grid"><img src="../assets/images/gdpr.svg" alt="General Data Protection Regulation" />
        <div class="secinner">
          <h2 class="extra-large-font">Secure transactions</h2>
          <p>Our financial transactions are conducted by secure services such as Paypal, World Remit, and CashApp.</p>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="alt-section-inner-grid">
        <div class="secinner">
          <h2 class="extra-large-font">The numbers love you</h2>
          <p>Only two YouTubers sell subscription boxes as of 2021. But there's a whopping 951k monthly Youtube searches for the phrase "subscription box." Source: TubeBuddy.</p>
        </div>
        <img src="../assets/images/love.svg" alt="Shoppers"/> </div>
    </section>
    <section class="section margin-bottom-10-em">
      <div class="alt-section-inner-grid"><img src="../assets/images/slamdunk.svg" alt="Easy business" />
        <div class="secinner">
          <h2 class="extra-large-font">It's easier than you think</h2>
          <p>You can offer a subscription box on any schedule that's easy for you to slam dunk. For proof of concept, see how Boxeon is being used by <a href='/box/?u=48' class='darkblue underline one-em-font' title='Proof of concept'>Prototype</a>.</p>
        </div>
      </div>
    </section>
      <br>
      <h2 class="centered">How it works</h2>
      <div id="how-it-works" class="four-col-grid">
        <div> <img src="assets/images/computer.svg" alt="Computer"/> <h2>Survey fans</h2></div>
        <div> <img src="assets/images/box.svg" alt="Box"/> <h2>Create box</h2></div>
        <div> <img src="assets/images/camera.svg" alt="Camera"/> <h2>Share box</h2></div>
        <div> <img src="assets/images/growth.svg" alt="Growth"/> <h2>Grow</h2></div>
      </div>
      <section class='section'> <br>
        <div class="centered margin-bottom-10-em">
          <h1 class="extra-large-font darkblue">It's that simple</h1>
          <br>
          <a class="button" href="{{ url('auth/google') }}"> Get started </a> </div>
      </section>
    </main>


@endsection
