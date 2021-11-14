
<?php
// BOXES NEEDING CURATION HELP
require_once "../mysqliclass.php";
$db = Database::getInstance();
$re = $db->get( "SELECT user.uid, user.fullname, boxes.ship_from, boxes.curation, user.country, user.email, user.phone FROM user INNER JOIN boxes ON user.uid=boxes.uid WHERE user.phone <> 'NULL' AND boxes.curation <> 0" );
	
echo "<main><span></span><div><h2>Curation applicants</h2><table id='t01'> <tr><th>Creator</th><th>Curation</th><th>Warehousing</th><th>Email</th><th>Phone</th><th>Country</th><th>Update form</th></tr>";

  $count = count($re);
for($i=0; $i < $count; $i++){

  $uid = $re[ $i ][ 'uid' ];
  $phone = $re[ $i ][ 'phone' ];
  $country = $re[ $i ][ 'country' ];
  $name = $re[ $i ][ 'fullname' ];
  $email = $re[ $i ][ 'email' ];
  $curation = $re[ $i ][ 'curation' ];
  $warehousing = $re[ $i ][ 'ship_from' ];
	
    echo "<tr><td>$name</td><td>$curation</td><td>$warehousing</td><td>$email</td><td>$phone</td><td>$country</td><td><form action='https://boxeon.com/admin/dashboard.php' method='post' enctype='multipart/form-data'> <fieldset>
  <input  type='number' required name='num_products' placeholder='Number of products in box'  min='1' max='1000000'>
  <input  type='number' required value='' placeholder='Weight of box in pounds' name='box_weight' min='1' max='1000000'>
  <input  type='number' required value='' placeholder='Length of box in inches' name='box_length' min='1' max='1000000'>
  <input  type='number' required value='' placeholder='Width of box in inches' name='box_width' min='1' max='1000000'>
  <input  type='number' required value='' placeholder='Height of box in inches' name='box_height' min='1' max='1000000'>
  <input type='hidden' value='$uid' name='uid'>
  </fieldset><input type='submit' value='Update'></form></td></tr>";
}

echo "</table></div><span></span></main>";
	
if(isset($_POST['num_products'])){
	$uid = $_POST['uid'];
	// CREATE PRODUCT
	require_once("../home/create-product.php");
	
	//UPDATE USER'S BOX
	unset($_POST['uid']); print($_POST);
	$db->update("boxes", $_POST, " WHERE uid=$uid");
	}
?>