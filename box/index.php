<?php
#SUBSCRIPTION BOX PAGE
##Handles a user emebeding a Youtube Video
##Serves a default page 
##Serves a customized page
## Allows Youtube video embed(UI/UX)



/* When this page is requested with the query string "?u=" in the URL
we take the value of "u" to identify the owner (Seller) 
of the page that is being requested.
*/
session_start();
require_once( "../mysqliclass.php" );
$db = Database::getInstance();
$uid = $_GET[ "u" ];
$sql = "SELECT givenname, fullname FROM user WHERE uid=$uid";
$owner = $db::get( $sql );
$creator = $owner[ 0 ][ "fullname" ];
$givenname = $owner[ 0 ][ "givenname" ];
/* The user requesting this page must be identified by our system for them
to interact with it.  So we create a sign in URL to populate
the default or custom pages with sign in links/buttons*/
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
	
# YOUTUBE VIDEO EMBED
	
	/* The final step in CREATE A BOX 
	is to embed a YouTube video by supplying the video URL. 
	The video ID is then taken from the URL and saved in the database. 
	This "if statement" gets the video ID, updates the database then 
	reloads the page so that the user sees their emebeded video.*/
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

   // Setting variables:
	
  /* Get information of the subscription box that is being reguested. 
  This info will be used to decide if to show a default page or 
  populate a custom page.
  */
  $id = $_GET[ "u" ];
  require_once "../mysqliclass.php";
  $db = Database::getInstance();
  $u = $db->get( "SELECT price, box_weight, box_supply, video FROM boxes WHERE uid=$uid" );
  $price = $u[ 0 ][ "price" ];
  $box_weight = $u[ 0 ][ "box_weight" ];
  $box_supply = $u[ 0 ][ "box_supply" ];
  //$in_stock = $u[ 0 ][ "in_stock" ]; // not yet implemented
	
	

# DEFAULT SUBSCRIPTION BOX PAGE
	
  /* To completely set up a subscription box, a seller 
  must provide the weight of the box, which will be used
  to calculate shipping cost. This is because shipping cost 
  is included in buyers' subscription price.
  Therefore, a subscription box page request must serve a default page 
  until the owner of the box provides box weight/finishes creating their subscriptopn box. 
  */
	
  // If a box_weight does not exist 
  if ( is_null( $box_weight ) ) {
	  
	  /* An embeded video is vital to a subscription box gaining subscribers. 
	  Therefore, if the box owner has not embeded a video, their subscription 
	  box page must remain in default page mode. 
	  So we check for the existense of said embed video.
	  */

    if ( is_null( $u[ 0 ][ "video" ] ) ) {

      /* The default subscription box page displays different messages
	  according to who is requesting the page. One set of messages are directed
	  at Sellers and the others are directed at Buyers. 
	  Therefore, we check ff the user requesting the page 
	  is authenticated and then check if they are the seller/owner 
	  of the page or possible buyer.*/
		
	  // If the user is authenticated
      if ( isset( $_SESSION[ 'uid' ] ) ) {
		  // If the user requeting the page owns the page
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
		// There is an embeded video in the user's account.
      $video = $u[ 0 ][ "video" ];

    }
    ?>
</div>
<?php
	  
# CUSTOMIZED SUBSCRIPTION BOX PAGE

if ( !is_null( $u[ 0 ][ "video" ] ) ) {
  if ( !isset( $url ) ) {
    $url = '?u=' . $id;
  }
}
} else {

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
	 <section class='section margin-bottom-10-em'>
      <div class='alt-section-inner-grid'>
        <div class='secinner'>
          <h1 class='extra-large-font'>Cancel anytime</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <img src='../images/still.svg' alt='subscription box'> </div>
    </section>
	 <h2 class='centered'>How it works</h2>
    <div id='how-it-works' class='four-col-grid'>
      <div> <img src='../images/search.svg' alt='Computer'/> <h2>Find box</h2></div>
      <div> <img src='../images/boxeons.svg' alt='Box'/> <h2>Subscribe</h2></div>
      <div> <img src='../images/card.svg' alt='Card'/> <h2>Add payment</h2></div>
      <div> <img src='../images/present.svg' alt='Box'/> <h2>Receive boxes</h2></div>
    </div>
	<br>
    <section>
      <div class='centered'>
        <h1 class='extra-large-font darkblue'>It's that simple</h1>
        <br>
        <a class='button' href='$signin_url'> Get started with $givenname </a> </div>
    </section>
		 </main>";

  } else {
	  
# ALLOW VIDEO EMBED(UI/UX)
	  
	/*This is the final step a seller takes 
	  in the CREATE A BOX flow, emebed a YouTube video. */
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
