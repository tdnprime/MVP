<?php
#MAIN LANDING

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Best way for creators to get sustainable income and connect with fans | Boxeon</title>
<meta name="description" content="Start and grow a subscription box business and secure monthly income without making extra content. It's the wave of the future."/>
<meta name="keywords" content="Boxeon, Patreon alternative, monitize content, Subscription box platform, make more money on Youtube">
<?php require_once("meta.html");?>
</head>
<body id='index'>
<div id="container">
  <?php require_once("header.php");?>
  <div id="masthead">
    <section id="headline">
      <p class="text-heading-label">BE A FREE SPIRIT WITH</p>
      <h1 class="ginormous">Liberating, monthly, sustainable income</h1>
      <p id="pitch">Finally, content creators can achieve the freedom they desire by offering their fans subscription boxes. Boxeon makes it a breeze.</p>
	<a class="button" href="<?php require_once "signin/create-url.php"; echo $client->createAuthUrl(); ?>"> Get started </a>
      <a href="#whatis" class="button clearbtn"> Learn more </a> </section>
    <div id="masthead-image"> </div>
  </div>
  <main> <a id='whatis' href='#whatis'></a>
    <aside id="business-model-explanation">
      <h1 class="extra-large-font darkblue">What's a subscription box?</h1>
      <p class="centered font-1-5-em">In this business model, content creators put together a box of products around a theme. And their most loyal fans subscribe to receive these boxes for the thematic experience. </p>
    </aside>
    <section class="section padding-top-6-em">
      <div class="section-inner-grid"> <img src="../images/hero.svg" alt='Why Boxeon'/>
        <div class="secinner">
          <h2 class="extra-large-font">Be the hero</h2>
          <p>Our <a href="/partner/" class="one-em-font darkblue underline">Partner Program</a> provides strategic guidance, logistics, and financial help to launch a subscription box.</p>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="alt-section-inner-grid">
        <div class="secinner">
          <h2 class="extra-large-font">Ship to mars</h2>
          <p>Once per month, you'll pack boxes, print shipping labels, and hand the boxes off for shipping. We'll handle complicated details like address verification, inventory control, customs, and more.</p>
        </div>
        <img src="../images/rocket.svg" alt="Shipping" /> </div>
    </section>
    <section class="section">
      <div class="section-inner-grid"> <img src="../images/winning.svg" alt="printing money"/>
        <div class="secinner">
          <h2 class="extra-large-font">Get to the finish line faster</h2>
          <p>The average Patreon contribution is a paltry $6.70 a month. 
            But the average profit margin on a subscription box is an incredible $15.00 per box.</p>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="alt-section-inner-grid">
        <div class="secinner">
          <h2 class="extra-large-font">We succeed, when you get a Ferrari</h2>
          <p>To make it easy for you to get started, we have no upfront fees. But your sales are subject to a <a href="/fees/" class="darkblue underline one-em-font">commission</a>.</p>
        </div>
        <img src="../images/car.svg" alt="Shipping" /> </div>
    </section>
    <section class="section">
      <div class="alt-section-inner-grid"><img src="../images/gdpr.svg" alt="Safety first" />
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
          <p>Only two YouTubers sell subscription boxes as of 2021. But there's a whopping 951k monthly Youtube searches for the phrase "subscription box."</p>
        </div>
        <img src="../images/love.svg" alt="Shoppers"/> </div>
    </section>
    <section class="section">
      <div class="alt-section-inner-grid"><img src="../images/slamdunk.svg" alt="Easy business" />
        <div class="secinner">
          <h2 class="extra-large-font">It's easier than you think</h2>
          <p>See how Boxeon is being used by the popular, <a href='/box/?u=48' class='darkblue underline one-em-font' title='Example Boxeon page'>Kelly Stamps</a>.</p>
        </div>
      </div>
    </section>
    <br>
    <h2 class="centered">How it works</h2>
    <div id="how-it-works" class="four-col-grid">
      <div> <img src="../images/computer.svg" alt="Computer"/> <h2>Survey fans</h2></div>
      <div> <img src="../images/box.svg" alt="Box"/> <h2>Create box</h2></div>
      <div> <img src="../images/camera.svg" alt="Camera"/> <h2>Share box</h2></div>
      <div> <img src="../images/growth.svg" alt="Growth"/> <h2>Grow</h2></div>
    </div>
    <section class='section'> <br>
      <div class="centered margin-bottom-10-em">
        <h1 class="extra-large-font darkblue">It's that simple</h1>
        <br>
        <a class="button" href="<?php require_once "signin/create-url.php"; echo $client->createAuthUrl(); ?>"> Get started </a> </div>
    </section>
  </main>
</div>
<?php require_once("footer.html");?>
</body>
</html>
