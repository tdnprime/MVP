<?php
$box = DB::select('select * from boxes where user_id= ?', [$user->id]); 
if(empty($box) || is_null($box[0]->box_weight)){
echo '<div id="masthead" class="fadein">
    <div id="headline">
    <div><p class="text-heading-label">FANS ARE WAITING</p><h1 class="ginormous">Create a 
    subscription box today</h1>
    <p id="pitch">If you started creating a box and chose to have us help you with product 
    curation and shipping, we will be
    contacting you by email. Please ensure our emails are not in your spam folder.</p>
    <a class="button" href="/box/create">Create box</a>
</div>
   </div>
    <div id="masthead-image-construction"></div>
</div>';
}else{
    $box_s = $box[0]->box_supply;
    $in_stock = $box[0]->in_stock;
    $video = $box[0]->video;
	$price = $box[0]->price;
	$id = $box_supply = $box[0]->user_id;
    $date = $box[0]->created_at;
    if($box[0]->shipping_cost == 0){
        $shipping = "+ shipping";
        $discount = "90% off on";
        $cost = 1;
    }else{
        $shipping = "Free shipping";
        $discount = "free";
        $cost = 0;
    }

	$url = url('auth/google');

	echo "<div id='masthead'>
    <div id='box-masthead-inner-wrapper'>
	<section id='box-headline'>
		<h1 class='darkblue'> 
		<span id='page-name' class='ginormous primary-color'>$user->given_name $user->family_name</span>
        <span class='break hack-br-1'><br></span> is shipping $box_s subscription boxes <br> 
        to loyal fans</h1> <div>
		<p><span class='highlighted darkblue'>$$price</span> per box ($shipping)</p>
		<!-- <p><span class='highlighted darkblue'>$20 off</span> when you <span class='break hack-br-2'><br>
        </span>
		<a class='one-em-font darkblue underline' href='#' title='Click to allow'>allow notifications</a>
        </p>!-->
		<p><span class='highlighted darkblue'>$in_stock</span> boxes left in stock</p>
        <span class='break hack-br-3'><br></span>
		<div class='sub-btns'>
		<a href='#' id='exe-sub' data-id='$id' data-url='$url' data-video-id='$video' 
        data-plan-id='1' class='button'>Subscribe</a>
		<a id='share-box' data-id='$id' data-url='$url' href='#' class='button clearbtn'>
        Share instead</a>
		</div>
		</section>";
        ?>
        <?php
        if(!isset($video)){
       echo "<div id='video-place-holder' class='centered'>
        <h1 class='extra-large-font'>Embed Video</h1>
      <div class='alert'>  <p class='material-icons'>info</p><p>To publish your page, embed a 
      <b>show and tell</b> Youtube video of your subscription box. 
        You may complete this step at any time by signing in and clicking on $user->given_name's 
        Boxeon.</p></div>
        <form action='/box/$user->id/edit' method='post' 
        id='embed-form'>";
        ?>

       @csrf
        @method('POST')

        <?php
        echo "<input required placeholder='Youtube video URL from browser' name='ytembed' 
        type='url'></input>
        <div class='buttonHolder'>
        <input type='submit' value='Embed'></input></div></form></div>
		</div>";
        }else{
            echo "<div id='masthead-video-wrapper'>
            <div class='playbtn-wrapper'>
            <img id='image-youtube-thumb' src='http://img.youtube.com/vi/$video/maxresdefault.jpg'/>
             <a href='#' id='play-video' data-shipping='$cost' data-id='$id' data-url='$url' data-video-id='$video' 
             data-plan-id='1'><img class='playbtn' src='../../assets/images/playbtn.png' 
             alt='Play video'/></a>
            </div>
            </div></div>";
        }
        ?>
        <?php
		 echo "</div>
		 <main class='fadein'>
		 <a id='whatis' href='#whatis'></a>
    <section class='section'>
      <div class='alt-section-inner-grid'>
        <div class='secinner'>
          <h1 class='extra-large-font'>Enjoy $user->given_name</h1>
          <p>
Subscribe to enjoy a curated experience that is uniquely $user->given_name.</p>
        </div>
        <img src='../../assets/images/smith.svg' alt='subscription box'> </div>
    </section>
    <section class='section'>
      <div class='section-inner-grid'> <img src='../../assets/images/freedom.svg' alt='subscription box'>
        <div class='secinner'>
          <h1 class='extra-large-font'>Give $user->given_name freedom</h1>
          <p>
          $user->given_name's subscription box is the best way to support $user->given_name's quest 
          for financial freedom to continue making the content you deserve.</p>
        </div>
      </div>
    </section>
    <section class='section'>
      <div class='alt-section-inner-grid'>
        <div class='secinner'>
          <h1 class='extra-large-font'>Special offer</h1>
          <p>
The first ten fans to <b>pre-order</b> will receive a 30-minute phone call with $user->given_name. 
Pre-order sales end on $date, and boxes will ship within one month after pre-order sales have ended.</p>
        </div>
        <img src='../../assets/images/fireworks.svg' alt='subscription box'> </div>
    </section>
		 <section class='section'>
      <div class='section-inner-grid'><img src='../../assets/images/sleep.svg' alt='subscription box'>
        <div class='secinner'> 
          <h1 class='extra-large-font'>Rest secured</h1>
          <p>
          We conduct all financial transactions securely via PayPal. No PayPal account 
          is necessary to subscribe.</p>
        </div>
         </div>
    </section>
	 <section class='section'>
      <div class='alt-section-inner-grid'>
        <div class='secinner'>
          <h1 class='extra-large-font'> Save on shipping</h1>
          <p>
Subscribe to $user->given_name's box today to secure $discount shipping.</p>
        </div>
        <img src='../../assets/images/high-five.svg' alt='subscription box'> </div>
    </section>
			 <section class='section'>
      <div class='section-inner-grid'><img src='../../assets/images/makeitrain.svg' 
      alt='subscription box'>
        <div class='secinner'> 
          <h1 class='extra-large-font'>Money back guarantee</h1>
          <p>We don't allow products of poor or medium quality on our platform. 
          They don't have to be expensive; they have to be of excellent quality. 
          We will return any fees collected from a customer who successfully proves 
          their seller violated this policy.</p>
        </div>
         </div>
    </section>
	 <section class='section margin-bottom-10-em'>
      <div class='alt-section-inner-grid'>
        <div class='secinner'>
          <h1 class='extra-large-font'>Cancel anytime</h1>
          <p>
If you're unsatisfied with $user->given_name's box, you may unsubscribe at anytime without hassle.</p>
        </div>
        <img src='../../assets/images/laptop.svg' alt='subscription box'> </div>
    </section>
	 <h2 class='centered'>How it works</h2>
    <div id='how-it-works' class='three-col-grid'>
     
      <div> <img src='../../assets/images/computer.svg' alt='Box'/> <h2>Find box</h2></div>
      <div> <img src='../../assets/images/card.svg' alt='Card'/> <h2>Add payment</h2></div>
      <div> <img src='../../assets/images/present.svg' alt='Box'/> <h2>Receive boxes</h2></div>
    </div>
	<br>
    <section class='margin-bottom-10-em'>
      <div class='centered'>
        <h1 class='extra-large-font darkblue'>We make it that simple</h1>
        <br>
        <a href='#' id='exe-sub-alt' data-id='$id' data-url='$url' data-video-id='$video' 
        data-plan-id='1' class='button'> Get started with $user->given_name </a> </div>
    </section>
		 </main>";
    }
    ?>