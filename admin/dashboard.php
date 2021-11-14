<?php
error_reporting( E_ALL & ~E_NOTICE );
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard </title>
<?php 
require_once("../meta.html");
echo '<script src="admin.js?v=1"></script>';
$config = parse_ini_file( "../config/app.ini", true );
?>
</head>
<!-- HEAD ENDS !-->
<body id='home'>
<div id="container">
<?php
require_once( "../header.php" );

require_once "menu.html";

echo "<main><span></span>
<div id='module'>
<p>DYNAMIC CONTENT GOES HERE</p>

</div>
<span></span></main>";
		
?>
	</div>
</div>
</body>
</html>
