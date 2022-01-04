<?php

$subs = DB::table("subscriptions") 
->join('boxes', 'boxes.user_id', '=', 'subscriptions.creator_id')
->join('users', 'users.id', '=', 'boxes.user_id')
->select('subscriptions.*', 'boxes.*', 'users.given_name', 'users.family_name')
->get();

echo "<div class='tab-content margin-top-4-em' data-id='anchor-tab-subscriptions' id='subscriptions-stream'>";

if(isset($subs[0])){
	$count = count($subs);
	for($i=0; $i < $count; $i++){
		$id = $subs[$i]->creator_id;
		$name = $subs[$i]->given_name . " " . $subs[$i]->family_name;
		$sub_id = $subs[$i]->sub_id;
		$frequency = $subs[$i]->frequency;
		$date_created = date("F j, Y", $subs[$i]->created_at);
		$tracking = $subs[$i]->tracking;
		$video = $subs[$i]->video;
		$box_url = $subs[$i]->box_url;
		echo "
		<div><iframe  
	  src='https://www.youtube.com/embed/$video?rel=0; modestbranding' 
	  frameborder='0' allow='accelerometer; autoplay; 
	  clipboard-write; 
	  encrypted-media; gyroscope; picture-in-picture'></iframe>
	  
	  <div class='secinner'>
	  	<div>
	    <b> <h2 class='extra-large-font'>$name</h2></b>
		<p>Ships in: $frequency month(s) intervals</p>
		<p>Date started: $date_created</p>
		<p>Last tracking number: $tracking</p>
		<p>View on page</p>
		</div>
		  	<div id='subs-btns'>
		<button  id='unsub' class='clearbtn' data-id='$id' data-plan-id='$sub_id' 
		 display:inline;'>Unsubscribe</button>
		</div></div>
	  </div>";
	}
	}else{
		echo '<div class="alert">
		<p class="material-icons">info</p>
		<p>You don\'t have any subscriptions to show.</p>
		  </div>';
}
echo "</div>";
