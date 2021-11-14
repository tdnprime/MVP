<?php
#HOME PAGE

session_start();
if (!isset( $_SESSION[ "uid" ]) && !isset($_GET["code"])) {
  require_once '../signin/create-url.php';
  header( "location:" . $url );
}
if(isset($_GET["code"])){
	require_once("../signin/callback.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Boxeon home </title>
<?php
require_once("../meta.html");
$config = parse_ini_file( "../config/app.ini", true );
echo "<script src=https://www.paypal.com/sdk/js?client-id=" . $config['paypal']['clientID'] . "&vault=true&intent=subscription></script>";
?>
</head>
<body id='home'>
<div id="progress">
  <div id="bar"></div>
</div>
<div id="container">
  <?php
  require_once( "../header.php" );

/*    
	MOVE TO POP UP WINDOW:
	
echo '<div id="masthead">
    <section id="headline">
      <h1 class="ginormous darkerblue">Hop and skip between boxes with the one payment</h1>
      <p id="pitch">Schedule your payment to go to different creators and enjoy a different box every shipment.</p>
      <a href="#whatis" class="button"> Learn more </a> </section>
    <div id="masthead-image-buyers-home"> </div>
  </div>';*/
  
  
    echo "<main>";

  if ( !empty( $_GET ) ) {
    echo "<section id='left-aside'>";
  }
  if ( !empty( $_GET ) ) {
    echo '</section><aside id="panel">';
  }

  if ( isset( $_GET[ 'q' ] ) && $_GET[ 'q' ] == 'l' ) { 
    require_once 'creators-guide.php';
  } elseif ( isset( $_GET[ 'cnb' ] ) ) {
    require_once 'create-new-box.php';
  }
  elseif ( isset( $_GET[ 'mb' ] ) ) {
    require_once 'settings.php';
  }
  elseif ( isset( $_GET[ 's' ] ) ) {
    require_once 'ship-boxes.php';
  }
  elseif ( isset( $_GET[ 'i' ] ) ) {
    require_once 'income.php';
  } else {
    require_once 'fans-home.php';
  }

  if ( empty( $_GET ) ) {
    echo "</aside><section id='right-aside'></section>";
  }
  ?>
  </main>
</div>

<?php
require_once( "../footer.html" );
?>
</div>
</body>
</html>