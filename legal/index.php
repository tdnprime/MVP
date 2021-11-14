<!DOCTYPE html>
	<html>
		<head>
			<title>Boxeon Legal - Privacy & Terms </title>
		<?php require_once("../meta.html");?>
		

				</head><!-- HEAD ENDS -->
				<body id='home'>
					<div id="container">
				<?php require_once("../header.php");?>
				<main id="global-main">
							
					<section id="left-aside">
			
					</section>
					
					<aside id="panel">	
					<script> 
					
					var d = new Date();
					var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
					//document.getElementById("date").innerHTML = days[d.getDay()];
					
					var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
					var month = document.createTextNode(months[d.getMonth()]);
					var day =  document.createTextNode(d.getDate());
					var comma = document.createTextNode(", ");
					var space = document.createTextNode(" ");  
			/* 		var x = document.getElementById("date");
					x.appendChild(comma);
					x.appendChild(month);
					x.appendChild(space);
					x.appendChild(day); */
					//document.getElementById("date").innerHTML = d.getFullYear();
					
					 </script>
					<?php
					
			
					// echo "<div class='progress-bg'>
		
					// <div class='progress-bar'>
					// <h3 class='raised'>0&nbsp;subscribers </h3>
					// </div>
					// <h3 class='goal'>Potential: 0</h3>
					// </div>";
				
					if(isset($_GET["q"]) && $_GET['q'] == 'logo'){
						
						require_once "guide.php";
						
					}
					
					if(isset($_GET["mbs"])){
					
						require_once "mbs.php";
					}
					
					if(isset($_GET["cnb"])){
						
						require_once "cnb.php";
					}	
					
					if( isset($_GET["mb"])){
						require_once "mb.php";
					}
					
					if( isset($_GET["s"])){
					  require_once "s.php"; 
					}
					
					if(isset($_GET["ss"])){
						require_once "ss.php";
					}
			
					if(isset($_GET["si"])){ // STAT
					require_once "si.php";
					}
					
					if(isset($_GET["e"])){
						require_once "e.php";
					}
				
					?>
					</aside><!--last !-->
					<section id='right-aside'>
			
					
					</section>
					</main>
					
					</div> <!-- CONTAINER ENDS !-->
					
					<?php require_once("../footer.html");
					 
					 ?>
				
					</div>
			</body>
		</html>