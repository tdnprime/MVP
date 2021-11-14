<?php
session_start();
require_once( "../mysqliclass.php" );
$db = Database::getInstance();
$uid = $_GET[ "u" ];
$sql = "SELECT givenname, fullname FROM user WHERE uid=$uid";
$owner = $db::get( $sql );
$creator = $owner[ 0 ][ "fullname" ];
$givenname = $owner[ 0 ][ "givenname" ];
require_once( "../signin/create-url.php" );
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo ucfirst($creator) . "'s"; ?> subscription box | Boxeon</title>
<?php 
require_once("../meta.html");
$config = parse_ini_file( "../config/app.ini", true );
// Subscriptions
echo "<script src=https://www.paypal.com/sdk/js?client-id=" . $config[ 'paypal' ][ 'clientID' ] . "&vault=true&intent=subscription></script>";

?>
</head>
<body id="box">
<div id="progress">
  <div id="bar"></div>
</div>
<div id="container">
  <?php
  require_once( "../header.php" );
  echo '<div id="masthead">';
  if ( isset( $_POST[ 'ytembed' ] ) ) {
    $code = $_POST[ 'ytembed' ];
    preg_match(
      '/[\\?\\&]v=([^\\?\\&]+)/', $code,
      $matches
    );
    $vid = $matches[ 1 ]; // should contain the youtube user id
    require_once "../mysqliclass.php";
    $db = Database::getInstance();
    $data = [];
    $data[ "video" ] = $vid;
    $uid = $_SESSION[ "uid" ];
    $db->update( "boxes", $data, "WHERE uid=$uid" );
    header( "Refresh:0" );
  }

  $id = $_GET[ "u" ];
  require_once "../mysqliclass.php";
  $db = Database::getInstance();
  $u = $db->get( "SELECT price, box_weight, box_supply, video FROM boxes WHERE uid=$uid" );
  $price = $u[ 0 ][ "price" ];
  $box_weight = $u[ 0 ][ "box_weight" ];
  $box_supply = $u[ 0 ][ "box_supply" ];
  // $in_stock = $u[ 0 ][ "in_stock" ];

  // If a box does not exist 
  if ( is_null( $box_weight ) ) {

    if ( is_null( $u[ 0 ][ "video" ] ) ) {

      // If user is authenticated

      if ( isset( $_SESSION[ 'uid' ] ) ) {
        if ( $id == $_SESSION[ 'uid' ] ) {
          $url = "https://boxeon.com/home/?cnb=cnb";
          echo "<div id='headline'><h1 class='ginormous'>Your box is still incomplete</h1>
				<p id='pitch'>If you chose to have us help you with product acquisition and shipping, we will be 
				contacting you by email to assist you. Please ensure that our emails aren't in your spam folder.</p>
				<a class='button' href='$url'>Finish box</a>
				</div>				
				<div id='masthead-image-construction'></div>
				</div>
				</div>";

        } else {
          $url = "https://boxeon.com/home/?cnb=cnb";
          echo "<div id='headline'><h1 class='ginormous'>Looks like $creator is still setting up.</h1>
				<p id='pitch'>The subcription box you're looking for has not been completed yet, but you can start selling today.</p>
				<a class='button' href='$url'>Create box</a>
				</div>				
				<div id='masthead-image-construction'></div>
				</div>
				</div>";
        }
      } else {

        $url = "https://boxeon.com/home/?cnb=cnb";
        echo "<div id='headline'><h1 class='ginormous'>Looks like $creator is still setting up.</h1>
				<p id='pitch'>The subcription box you're looking for has not been completed yet, but you can start selling today.</p>
				<a class='button' href='$url'>Create box</a>
				</div>				
				<div id='masthead-image-construction'></div>
				</div>
				</div>";

      }
    } else {
      $video = $u[ 0 ][ "video" ];

    }
    ?>
</div>
<?php

if ( !is_null( $u[ 0 ][ "video" ] ) ) {
  if ( !isset( $url ) ) { // $url is set in header.php. 
    $url = '?u=' . $id;
  }
}


} else {
  // IF A BOX WEIGHT EXIST 
  if ( !is_null( $u[ 0 ][ "video" ] ) ) {

    $table = "subscriptions";
    $subbed = $db->get( "SELECT sub_id FROM $table WHERE uid=" . $_SESSION[ 'uid' ] );
    if ( isset( $subbed ) ) {
      echo $sub_id = $subbed[ "sub_id" ];
    } else {
      $sub_id = 0;
    }
    $video = $u[ 0 ][ "video" ];
    require_once '../signin/create-url.php';
    $signin_url = $client->createAuthUrl();
    echo "<section id='box-background-image'></section>";
    echo "<div id='box-masthead-inner-wrapper'>
	<img id='image-previous-arrow' src='../images/arrow.svg' title='Previous' alt='Previous'/>
	<section id='headline'>
	
		<h1 class='darkblue extra-large-font'> 
		<span id='page-name' class='ginormous'>$creator</span> <br>is shipping $box_supply boxes <br> to loyal fans</h1> <div>
		<p><span class='highlighted darkblue'>$$price</span> per box (plus shipping and handling)</p>
		<p><span class='highlighted darkblue'>$20 off</span> when you <a class='one-em-font darkblue underline' href='#'>allow notifications</a></p>
		<p><span class='highlighted darkblue'>$box_supply</span> boxes left in stock</p><br>
		<div id='box-masthead-btn-wrapper'>
		<a href='#' id='exe-sub' data-id='$id' data-url='$url' data-plan-id='1' class='button'>Get started with $givenname</a>
		&nbsp; <a href='#whatis' class='button clearbtn'> Learn more </a>
		</div>
		</section>
		<div id='masthead-video-wrapper'>
		<div class='playbtn-wrapper'>
		<img src='http://img.youtube.com/vi/$video/maxresdefault.jpg'/>
		<img id='play-video' data-video-id='$video' class='playbtn' src='../images/playbtn.png' alt='Play video'/>
		</div>
		</div>
		<img id='image-next-arrow' src='../images/arrow.svg' title='Next' alt='Next'/>
		</div>
		 </div>
		
		 <main class='fadein'>
		 <a id='whatis' href='#whatis'></a>
    <section class='section'>
      <div class='alt-section-inner-grid'>
        <div class='secinner'>
          <h1 class='extra-large-font'>Enjoy $givenname's curated experience</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <img src='../images/wishes.svg' alt='subscription box'> </div>
    </section>
    <section class='section'>
      <div class='section-inner-grid'> <img src='../images/freedom.svg' alt='subscription box'>
        <div class='secinner'>
          <h1 class='extra-large-font'>Give $givenname the gift of freedom</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
    </section>
    <section class='section'>
      <div class='alt-section-inner-grid'>
        <div class='secinner'>
          <h1 class='extra-large-font'>Secure Transactions</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <img src='../images/sleep.svg' alt='subscription box'> </div>
    </section>
		 <section class='section'>
      <div class='section-inner-grid'><img src='../images/makeitrain.svg' alt='subscription box'>
        <div class='secinner'> 
          <h1 class='extra-large-font'>Don't make it rain</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
         </div>
    </section>
	 <section class='section'>
      <div class='alt-section-inner-grid'>
        <div class='secinner'>
          <h1 class='extra-large-font'>Cancel anytime</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <img src='../images/still.svg' alt='subscription box'> </div>
    </section>
	<br>
	 <h2 class='centered'>How it works</h2>
    <div id='how-it-works' class='four-col-grid'>
      <div> <img src='../images/search.svg' alt='Computer'/> <h2>Find box</h2></div>
      <div> <img src='../images/boxeons.svg' alt='Box'/> <h2>Subscribe</h2></div>
      <div> <img src='../images/card.svg' alt='Card'/> <h2>Add payment</h2></div>
      <div> <img src='../images/present.svg' alt='Box'/> <h2>Receive boxes</h2></div>
    </div>
	<br>
    <section>
      <div class='centered margin-bottom-10-em'>
        <h1 class='extra-large-font darkblue margin-top-4-em'>It's that simple</h1>
        <br>
        <a class='button' href='$signin_url'> Get started with $givenname </a> </div>
    </section>
		 </main>";

  } else {
	 // Allows video embed
    echo "<div id='video-place-holder' class='centered'>
	<h1 class='extra-large-font'>Embed Video</h1>
	<p>Embed a show and tell Youtube video for your subscription box. You may complete 
	this step at any time by signing in and clicking on your username.</p>
	<form action='../box/?u=$id' method='post' 
	id='embed-form' enctype='multipart/form-data'>
	<input required placeholder='Youtube video URL from BROWSER' name='ytembed' type='url'></input>
	<div class='buttonHolder'>
	<input type='submit' value='Embed'></input></div></form></div>";
  }

}
?>
</div>
<?php
require_once( "../footer.html" );
?>
</div>
</body>
</html>
