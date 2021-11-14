<?php 
#PARTNER PROGRAM
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
<title>Boxeon partner program</title>
<?php require_once("../meta.html");?>
</head>
<!-- HEAD ENDS -->
<body>
<div id="container">
  <?php require_once("../header.php");?>
  <div id="masthead">
    <section id="headline">
		<p class="text-heading-label">BECOME A PARTNER</p>
      <h1 class="ginormous">Take the leap, Boxeon will give you wings</h1>
      <p id="pitch">Apply to our partner program if you're a creator with at least 10,000 average views. We're giving qualified applicants up to $20,000 in help to launch a subscription box business on Boxeon.</p>
		<a class="button" href="<?php require_once "../signin/create-url.php"; echo $client->createAuthUrl(); ?>"> Get started </a>&nbsp;
      <a href="#whatis" class="button clearbtn"> Learn more </a> </section>
    <div id="masthead-image-products"> </div>
  </div>
  <main> <a id='whatis' href='#whatis'></a>
    <aside id="business-model-explanation">
      <h1 class="extra-large-font darkblue">How it works</h1>
      <p class="centered font-1-5-em">
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </aside>
    <section class="section">
      <div class="alt-section-inner-grid">
        <div class="secinner">
          <h1 class="extra-large-font">Personal account manager</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <img src="../images/road.svg" alt="subscription box"> </div>
    </section>
    <section class="section">
      <div class="section-inner-grid"> <img src="../images/support.svg" alt="subscription box">
        <div class="secinner">
          <h1 class="extra-large-font">Ethically sourced products</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="alt-section-inner-grid">
        <div class="secinner">
          <h1 class="extra-large-font">Free warehouse space and fulfillment</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <img src="../images/stand-out.svg" alt="subscription box"> </div>
    </section>
	      <section class="section">
      <div class="section-inner-grid"><img src="../images/better_world.svg" alt="subscription box">
        <div class="secinner">
			 
          <h1 class="extra-large-font">Foster a better world</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
         </div>
    </section>
	     <section class="section">
      <div class="alt-section-inner-grid">
        <div class="secinner">
          <h1 class="extra-large-font">We're stronger together</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <img src="../images/goals.svg" alt="subscription box"> </div>
    </section>
    <section>
      <div class="centered margin-bottom-10-em">
        <h1 class="extra-large-font darkblue margin-top-4-em">It's that simple</h1>
        <br>
        <a class="button" href="<?php require_once "../signin/create-url.php"; echo $client->createAuthUrl(); ?>"> Get started </a> </div>
    </section>
  </main>
</div>
<?php
require_once( "../footer.html" );
?>
</div>
</body>
</html>
