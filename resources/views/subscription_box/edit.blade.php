@extends('layouts.box')

@section('content')


<?php
$box = DB::select('select * from boxes where user_id= ?', [$user->id]); 
if(empty($box) || is_null($box[0]->box_weight)){
echo '<div id="masthead" class="fadein">
    <div id="headline">
    <div><p class="text-heading-label">FANS ARE WAITING</p><h1 class="ginormous">Create a subscription box today</h1>
    <p id="pitch">If you started creating a box and chose to have us help you with product curation and shipping, we will be
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
	$price = $box[0]->price + 20;
	$id = $box_supply = $box[0]->user_id;
    if($box[0]->shipping_cost == 0){
        $shipping = "+ shipping";
    }else{
        $shipping = "Free shipping";
    }
	$end_of_first_month = "June 21";
	$url = url('auth/google');

	echo "<div id='masthead'>
    <div id='text-modes-switch' class='center'>
    <a href='/box/index' target='_blank' class='text-edit-mode' class='centered'><span class='material-icons'>open_in_new</span> Live Mode</a>
   <a href='/box/$user->id/edit' class='text-edit-mode' class='centered'><span class='material-icons'>edit</span> Edit Mode</a>
   </div>
    <div id='box-masthead-inner-wrapper'>
	<section id='box-headline'>
		<h1 class='darkblue'> 
		<span id='page-name' class='ginormous primary-color'>$user->given_name $user->family_name</span><span class='break hack-br-1'><br></span> is shipping $box_s subscription boxes <br> to loyal fans</h1> <div>
		<p><span class='highlighted darkblue'>$$price</span> per box ($shipping)</p>
		<p><span class='highlighted darkblue'>$20 off</span> when you <span class='break hack-br-2'><br></span>
		<a class='one-em-font darkblue underline' href='#' title='Click to allow'>allow notifications</a></p>
		<p><span class='highlighted darkblue'>$in_stock</span> boxes left in stock</p><span class='break hack-br-3'><br></span>
		<div class='sub-btns'>
		<a href='#' id='exe-sub' data-id='$id' data-url='$url' data-video-id='$video' data-plan-id='1' class='button'>Subscribe</a>
		<a id='share-box' data-id='$id' data-url='$url' href='#' class='button clearbtn'>Share instead</a>
		</div>
		</section>";
        ?>
        <?php
        if(!isset($video)){
       echo "<div id='video-place-holder' class='centered'>
        <h1 class='extra-large-font'>Embed Video</h1>
      <div class='alert'>  <p class='material-icons'>info</p><p>To publish your page, embed a <b>show and tell</b> Youtube video of your subscription box. 
        You may complete this step at any time by signing in and clicking on $user->given_name's Boxeon.</p></div>
        <form action='/box/$user->id/edit' method='post' 
        id='embed-form'>";
        
        ?>

        @csrf
        @method('POST')

        <?php
        echo "<input required placeholder='Youtube video URL from browser' name='ytembed' type='url'></input>
        <div class='buttonHolder'>
        <input type='submit' value='Embed'></input></div></form></div>
		</div>";
        }else{
            echo "<div id='masthead-video-wrapper'>
            <div class='playbtn-wrapper'>
            <img id='image-youtube-thumb' src='http://img.youtube.com/vi/$video/maxresdefault.jpg'/>
             <a href='#' id='play-video' data-id='$id' data-url='$url' data-video-id='$video' data-plan-id='1'><img class='playbtn' src='../../assets/images/playbtn.png' alt='Play video'/></a>
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
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <img src='../../assets/images/smith.svg' alt='subscription box'> </div>
    </section>
    <section class='section'>
      <div class='section-inner-grid'> <img src='../../assets/images/freedom.svg' alt='subscription box'>
        <div class='secinner'>
          <h1 class='extra-large-font'>Give $user->given_name freedom</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
    </section>
    <section class='section'>
      <div class='alt-section-inner-grid'>
        <div class='secinner'>
          <h1 class='extra-large-font'>Free box Surfing</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <img src='../../assets/images/surfer.svg' alt='subscription box'> </div>
    </section>
		 <section class='section'>
      <div class='section-inner-grid'><img src='../../assets/images/sleep.svg' alt='subscription box'>
        <div class='secinner'> 
          <h1 class='extra-large-font'>Rest secured</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
         </div>
    </section>
	 <section class='section'>
      <div class='alt-section-inner-grid'>
        <div class='secinner'>
          <h1 class='extra-large-font'>90% off on shipping</h1>
          <p>
Subscribe to $user->given_name's box before $end_of_first_month and secure 90% off on shipping.</p>
        </div>
        <img src='../../assets/images/high-five.svg' alt='subscription box'> </div>
    </section>
			 <section class='section'>
      <div class='section-inner-grid'><img src='../../assets/images/makeitrain.svg' alt='subscription box'>
        <div class='secinner'> 
          <h1 class='extra-large-font'>Money back guarantee</h1>
          <p>We don't allow products of poor or medium quality on our platform. They don't have to be expensive; they have to be of excellent quality. We will return any fees collected from a customer who successfully proves their seller violated this policy.</p>
        </div>
         </div>
    </section>
	 <section class='section margin-bottom-10-em'>
      <div class='alt-section-inner-grid'>
        <div class='secinner'>
          <h1 class='extra-large-font'>Cancel anytime</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
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
        <a href='#' id='exe-sub-alt' data-id='$id' data-url='$url' data-video-id='$video' data-plan-id='1' class='button'> Get started with $user->given_name </a> </div>
    </section>
		 </main>";
}
?>
<?php
#EMBED YOUTUBE VIDEO

  if ( isset( $_POST[ 'ytembed' ] ) ) {
    $code = $_POST[ 'ytembed' ];
    preg_match(
      '/[\\?\\&]v=([^\\?\\&]+)/', $code,
      $matches
    );
    $vid = $matches[ 1 ]; // should contain the youtube user id
    $array = [];
    $array[ "video" ] = $vid;
    $box = DB::table('boxes')->where('user_id', $user->id)->limit(1);
    $box->update($array);
    header( "Refresh:0" );
  }
?>
@endsection
