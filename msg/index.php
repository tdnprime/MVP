<?php 



require_once "../mysqliclass.php";





if($_SERVER["REQUEST_METHOD"] == "POST"){

	

	if(isset($_SERVER["HTTP_MSG"])){

		

		echo $id = $_SERVER["HTTP_MSG"];

		

		//header('location:../user/?u=' . $id);

	}

}













?>