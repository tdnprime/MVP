<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<title>About Boxeon</title>
<?php require_once("../meta.html");?>
</head>
<body id="home">
<div id="container">
  <?php require_once("../header.php");?>
  <div id="masthead">
    <section id="headline">
      <h1 class='ginormous'>Make an impact and the income will follow</h1>
		<p id='pitch'>Boxeon is a subscription box platform born of an acute desire to make an impact by creating win-win relationships between creators on the rise and artisans in developing countries.</p>
		<a href="#whatis" class="button"> Learn more </a>
      </section>
    <div id="masthead-image-about"> </div>
  </div>
  <main>
	  <span id="whatis"></span>
  <aside id="business-model-explanation">
    <h1  class="extra-large-font darkblue">Mission</h1>
    <p class="centered" style="font-size: 1.5em;">The increase and diffussion of wealth.</p>
  </aside>
  <section class="section">
  <div class="section-inner-grid"> <img src="../images/who.svg" alt="subscription box">
    <div class="secinner">
      <h1 class="extra-large-font">Who we are</h1>
      <p>A global team of experts working together to make globalization work for the many, not only the few.</p>
    </div>
    </section>
	  <section class="section">
  <div class="alt-section-inner-grid"> 
    <div class="secinner">
      <h1 class="extra-large-font">How we work</h1>
      <p>Our motto is the foundation for how we conduct business: People first.</p>
    </div>
	  <img src="../images/work.svg" alt="subscription box">
    </section>
  <section class="section large-margin-bottom">
  <div class="section-inner-grid"> <img src="../images/values.svg" alt="subscription box">
    <div class="secinner">
      <h1 class="extra-large-font">Values in action</h1>
		<p>Our <a href="/partner/" class="one-em-font darkblue underline">partner program</a> leverages our platform and resources to support on the rise creators.</p>
    </div>
    </section>
	<section class="section">
  <div class="alt-section-inner-grid"> 
    <div class="secinner">
      <h1 class="extra-large-font">Our pedigree</h1>
      <p>Our team of industry professionals are drawn from such companies as Microsoft, Disney, and many more.</p>
    </div>
	  <img src="../images/savvy.svg" alt="subscription box">
    </section>
n<section class="section large-margin-bottom">
  <div class="section-inner-grid"> <img src="../images/where.svg" alt="subscription box">
    <div class="secinner">
      <h1 class="extra-large-font">How to reach us</h1>
      <p>For business inquiries, find us on <a href="https://www.linkedin.com/company/boxeon/people/?viewAsMember=true" target="_blank" class="darkblue underline one-em-font">LinkedIn</a>.</p>
    </div>
    </section>
	<section>
      <div class="centered" style="margin-bottom:10em;">
        <h1 style='margin-top: 4em;' class="extra-large-font darkblue">Be the first in your niche to join</h1>
        <br>
        <a class="button" href="<?php require_once "../signin/create-url.php"; echo $client->createAuthUrl(); ?>">
        Get started
        </a> </div>
    </section>
    </main>
  </div>
  <?php require_once("../footer.html");?>
</div>
</body>
</html>