<?php

$subs = DB::table("subscriptions")
    ->join('boxes', 'boxes.user_id', '=', 'subscriptions.creator_id')
    ->join('users', 'users.id', '=', 'boxes.user_id')
	->where('subscriptions.user_id', '=', $user->id)
	->where('sub_id', '<>', null)
    ->select('subscriptions.*', 'boxes.*', 'users.given_name', 'users.family_name')
    ->get();

echo "<div class='tab-content margin-top-4-em' data-id='anchor-tab-subscriptions' id='subscriptions-stream'>";

if (isset($subs[0])) {
    $count = count($subs);
    for ($i = 0; $i < $count; $i++) {
        $id = $subs[$i]->creator_id;
        $name = $subs[$i]->given_name . " " . $subs[$i]->family_name;
        $sub_id = $subs[$i]->sub_id;
        $frequency = $subs[$i]->frequency;
        $date_created = date("F j, Y", $subs[$i]->created_at);
        $video = $subs[$i]->video;
		$box_url =  $subs[$i]->box_url;
		$version = $subs[$i]->version;
        echo "<div>
		<a href='/$box_url'><img id='image-youtube-thumb' src='http://img.youtube.com/vi/$video/mqdefault.jpg'/></a>
	  <div class=''>
	  	<div>
	    <b> <a href='/$box_url'><h2 class='extra-large-font'>$name</h2></a></b>
		<p>Ships to you in $frequency month intervals</p>
		<p>Started $date_created</p>
		</div>
		  	<div id='subs-btns'>
		<button  id='exe-unsub' class='clearbtn' data-version='$version' data-id='$id' data-plan-id='$sub_id'
		 display:inline;'>Unsubscribe</button>
		</div></div>
	  </div>";
    }
} else {
    echo '<div class="alert">
		<p class="material-icons">info</p>
		<p>You don\'t have any subscriptions to show.</p>
		  </div>';
}
echo "</div>";
