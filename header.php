<?php
#HEADER

$config = parse_ini_file( "config/app.ini", true );
?>

<span></span><!-- Hack-->
<header> <a href="#" title="Menu" id='menu-icon'> <img src="../images/menu.svg" alt="Menu"></a> <a id='logo' href="/home" title='Home'> <img src="../images/logo.svg" alt="logo"/><span id="beta">Beta</span></a>
  <?php
// Desktop Signin
 if(!isset($_SESSION["uid"]) && !isset($_GET["code"])){
  require_once "signin/create-url.php";
  $url = $client->createAuthUrl();
  echo "<a id='signin' href='$url'>
	Sign in with Google
	</a>";
 }

if ( isset( $_SESSION[ "uid" ] ) ) {
  $pic = $_SESSION[ "pic" ];
  $uid = $_SESSION[ "uid" ];
  $name = $_SESSION[ "givenname" ];
  $_SESSION[ "name" ] = $_SESSION[ "givenname" ] . " " . $_SESSION[ "familyname" ];

  echo "<a id='current-user' href='../box/?u=$uid' 
				title='$name'><span>
				<img id='profile-pic' src='$pic'/>
					</span>$name</a>";
}
  ?>
</header>
<?php
require_once "menu.html";
?>
<?php
// Mobile Signin
if(!isset($_SESSION["uid"]) && !isset($_GET["code"])){
  require_once "signin/create-url.php";
$url = $client->createAuthUrl();
echo "<div id='mobile-signin'><a class='signin centered' href='$url'>
	Sign in with Google
	</a></div>";
}
?>
