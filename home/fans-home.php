<?php
#Fans Home

// Recommend boxes or show subscriptions

require_once("../mysqliclass.php");
$db = Database::getInstance();

// Recommend boxes

$user = $_SESSION[ "givenname" ];
$boxes = $db->get( "SELECT * FROM boxes WHERE uid <> $uid LIMIT 40" );
if ( isset( $boxes[ 0 ] ) ) {
  echo "<span id='left-aside'></span><div id='panel'>
<div class='margin-top-4-em vertical-align'>
	<div id='tabs-wrapper'>
	<ul id='tabs'><li><a id='show-recommended' class='one-em-font' href='#'>Recommended</a></li>
	<li><a class='one-em-font' id='show-subscriptions' href='#'>Subscriptions</a></li>
	<li><a class='one-em-font' id='launch-search' href='#'>Search</a></li>
	<li><a class='one-em-font' id='tracking' href='#'>Tracking</a></li>
	</ul>
	</div>
</div>";

  $count = count( $boxes );
  for ( $i = 0; $i < $count; $i++ ) {
    if ( !is_null( $video = $boxes[ $i ][ "video" ] ) ) {
      $description = $boxes[ $i ][ "description" ];
      $name = $boxes[ $i ][ "page_name" ];
      $id = $boxes[ $i ][ "uid" ];
      echo "<div id='home-videos-wrapper'><div id='$id'>
	  <div class='playbtn-wrapper'>
	  <img src='http://img.youtube.com/vi/$video/mqdefault.jpg'/>
	  <img id='play-video' data-video-id='$video' class='playbtn' src='../images/playbtn.png' alt='Play video'/>
	  </div>
		<br>
	  <p>$name</p>
	  <p>$description</p>
	  </div></div>";
    }
  }
  echo "</div>";
} else {
  echo "<h2>What would you like to do, $givenname?</h2>
  <div class='alert'><p>Create</p><p>Find</p><p>Learn</p></div>";
}

// Get boxes user is subbed to

$subs = $db->get( "SELECT * FROM subscriptions INNER JOIN boxes ON subscriptions.creator_id=boxes.uid WHERE subscriptions.uid=$uid" );
if ( isset( $subs[ 0 ] ) ) {
  echo '<aside id="business-model-explanation">
      <h1 id="whatis" class="extra-large-font darkblue">Your subscriptions</h1></aside>';
  $count = count( $subs );
  for ( $i = 0; $i < $count; $i++ ) {
    $id = $subs[ $i ][ 'creator_id' ];
    $name = $subs[ $i ][ 'page_name' ];
    $sub_id = $subs[ $i ][ 'sub_id' ];
    $frequency = $subs[ $i ][ 'frequency' ];
    $date_created = date( "F j, Y", $subs[ $i ][ 'date_created' ] );
    $last_shipping = date( "F j, Y", $subs[ $i ][ 'last_shipping' ] );
    $tracking = $subs[ $i ][ 'tracking' ];
    $video = $subs[ $i ][ 'video' ];
    $carrier = $subs[ $i ][ 'carrier' ];
    echo "<section class='section'><div class='alt-section-inner-grid'>
		<iframe  
	  src='https://www.youtube.com/embed/$video?rel=0; modestbranding' 
	  frameborder='0' allow='accelerometer; autoplay; 
	  clipboard-write; 
	  encrypted-media;gyroscope; picture-in-picture'></iframe>
	  <div class='secinner'>
	  	<div>
	    <b> <h2 class='extra-large-font'>$name</h2></b>
		<p>Ships in: $frequency month(s) intervals</p>
		<p>Date started: $date_created</p>
		<p>Last shipping: $last_shipping</p>
		<p>Last tracking number: $tracking</p>
		<p>Carrier: $carrier</p>
		</div>
		  	<div id='subs-btns'>
		<button  id='exe-unsub' class='clearbtn' data-url='$url' data-id='$id' data-plan-id='$sub_id' 
		 display:inline;'>Remove</button>
		</div></div>
	  </section>";
  }
}
?>