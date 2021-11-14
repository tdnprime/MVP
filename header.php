<?php
#HEADER
## Serves up the HTML header portion of all pages
## Creates sign in URL for Desktop
## Creates sign in URL for Mobile
## Displays the name and thumbnail of the authenticated user
## Displays left sidebar menu


/*
Required configuration file:
*/
$config = parse_ini_file( "config/app.ini", true );
?>
<span></span><!-- Hack-->
<header> <a href="#" title="Menu" id='menu-icon'> 
	<img src="../images/menu.svg" alt="Menu"></a> 
	<a id='logo' href="/home" title='Home'> 
		<img src="../images/logo.svg" alt="logo"/>
		<span id="beta">Beta</span></a>
  <?php

  # CREATE GOOGLE SIGN IN URL (DESKTOP)

  /*This sign in URL is being used for desktop signin only. 
  For user experience reasons, a sign in URL is generated, marked up, 
  and styled for mobile devices.*/
  if ( !isset( $_SESSION[ "uid" ] ) && !isset( $_GET[ "code" ] ) ) {
    require_once "signin/create-url.php";
    $url = $client->createAuthUrl();
    echo "<a id='signin' href='$url'>
	Sign in with Google
	</a>";
  }

  # DISPLAY AUTHENTICATED USER

  if ( isset( $_SESSION[ "uid" ] ) ) {
    $pic = $_SESSION[ "pic" ];
    $uid = $_SESSION[ "uid" ];
    $name = $_SESSION[ "givenname" ];
    $_SESSION[ "name" ] = $_SESSION[ "givenname" ] . " " . $_SESSION[ "familyname" ];
    echo "<a id='current-user' href='../box/?u=$uid' title='$name'><span><img id='profile-pic' src='$pic'/></span>$name</a>";
  }
  ?>
</header>
<?php

#MENU

/*This is the menu on the left sidebar used by
customers. Note that the Admin dashboard has its 
own, unique, menu in its left sidebar.
*/
require_once "menu.html";
?>
<?php

# CREATE GOOGLE SIGNIN URL (MOBILE)

if ( !isset( $_SESSION[ "uid" ] ) && !isset( $_GET[ "code" ] ) ) {
  require_once "signin/create-url.php";
  $url = $client->createAuthUrl();
  echo "<div id='mobile-signin'><a class='signin centered' href='$url'>
	Sign in with Google
	</a></div>";
}
?>
