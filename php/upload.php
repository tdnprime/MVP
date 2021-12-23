<?php

die();

$target_dir = "../uploads/";

$target_file = $target_dir . $uid . $_FILES["upload"]["name"];

$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



// Check if image file is a actual image or fake image

if(isset($_POST["submit"])) {

	$check = getimagesize($_FILES["upload"]["tmp_name"]);

  if($check !== false) {

    echo "File is an image - " . $check["mime"] . ".";

    $uploadOk = 1;

  } else {

    echo "File is not an image.";

    $uploadOk = 0;

  }

}



// Check if file already exists

if (file_exists($target_file)) {

 // echo "Sorry, file already exists.";

  $uploadOk = 0;

}



// Check file size

/* if ($_FILES["upload"]["size"] > 5000000) {

  echo "Sorry, your file is too large.";

  $uploadOk = 0;

} */



// Allow certain file formats

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"

&& $imageFileType != "gif" ) {

  echo "<p class='center-text red'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";

  $uploadOk = 0;

}



// Check if $uploadOk is set to 0 by an error

if ($uploadOk == 0) {

 // echo "Sorry, your file was not uploaded.";

// if everything is ok, try to upload file

} else {

	if ($r = move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {

		

		// Update the user's box table with url

		require_once "../mysqliclass.php";

		$data = [];

		$data["photo"] = $target_file;

		$clause =  " WHERE uid=" . $uid;

		$db->update('user', $data, $clause);

		//header("Refresh:0");

		

		//echo "The file ". htmlspecialchars( basename( $_FILES["upload"]["name"])). " has been uploaded.";

  } 

  else {

    echo "<p class='center-text red'>Sorry, there was an error uploading a file:</p> " . $r;

   

  }

}

?>