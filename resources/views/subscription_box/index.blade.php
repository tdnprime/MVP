@extends('layouts.box')

@section('content')

@section('content')
<?php

$box = DB::select('select * from boxes where user_id= ?', [$user->id]); 
if(empty($box) || is_null($box[0]->box_weight) || is_null($box[0]->video) ){
	echo "<div id='masthead'>
	<div id='headline'><p class='text-heading-label'><p class='text-heading-label'>YOU'RE A BIT EARLY</p></p><h1 class='ginormous'>Looks like $user->given_name is still setting up.</h1>
					<p id='pitch'>The subcription box you're looking for has not been completed yet. If you're the page owner, embed your show and tell Youtube video in Edit Mode to publish your subscription box.</p>
					<a class='button' href='/box/1/edit'>Edit mode</a>
					</div>				
					<div id='masthead-image-construction'></div>
					</div>
					</div>
	</div>";

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
	echo "<div id='masthead'><div id='box-masthead-inner-wrapper'>
	<section id='box-headline'>
		<h1 class='darkblue'> 
		<span id='page-name' class='ginormous primary-color'>$user->given_name $user->family_name</span><span class='break hack-br-1'><br></span> is shipping $box_s subscription boxes <br> to loyal fans</h1> <div>
		<p><span class='highlighted darkblue'>$$price</span> per box (+ shipping)</p>
		<p><span class='highlighted darkblue'>$20 off</span> when you <span class='break hack-br-2'><br></span>
		<a class='one-em-font darkblue underline' href='#' title='Click to allow'>allow notifications</a></p>
		<p><span class='highlighted darkblue'>$in_stock</span> boxes left in stock</p><span class='break hack-br-3'><br></span>
		<div class='sub-btns'>
		<a href='#' id='exe-sub' data-id='$id' data-url='$url' data-video-id='$video' data-plan-id='1' class='button'>Subscribe</a>
		<a id='share-box' data-id='$id' data-url='$url' href='#' class='button clearbtn'>Share instead</a>
		</div>
		</section>
		<div id='masthead-video-wrapper'>
		<div class='playbtn-wrapper'>
		<img id='image-youtube-thumb' src='http://img.youtube.com/vi/$video/maxresdefault.jpg'/>
		 <a href='#' id='play-video' data-id='$id' data-url='$url' data-video-id='$video' data-plan-id='1'><img class='playbtn' src='../assets/images/playbtn.png' alt='Play video'/></a>
		</div>
		</div>
		</div>
		</div>
		 </div>


		 <main class='fadein'>
		 <a id='whatis' href='#whatis'></a>
    <section class='section'>
      <div class='alt-section-inner-grid'>
        <div class='secinner'>
          <h1 class='extra-large-font'>Enjoy $user->given_name</h1>
          <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <img src='../assets/images/smith.svg' alt='subscription box'> </div>
    </section>
    <section class='section'>
      <div class='section-inner-grid'> <img src='../assets/images/freedom.svg' alt='subscription box'>
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
        <img src='../assets/images/surfer.svg' alt='subscription box'> </div>
    </section>
		 <section class='section'>
      <div class='section-inner-grid'><img src='../assets/images/sleep.svg' alt='subscription box'>
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
        <img src='../assets/images/high-five.svg' alt='subscription box'> </div>
    </section>
			 <section class='section'>
      <div class='section-inner-grid'><img src='../assets/images/makeitrain.svg' alt='subscription box'>
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
        <img src='../assets/images/laptop.svg' alt='subscription box'> </div>
    </section>
	 <h2 class='centered'>How it works</h2>
    <div id='how-it-works' class='three-col-grid'>
     
      <div> <img src='../assets/images/computer.svg' alt='Box'/> <h2>Find box</h2></div>
      <div> <img src='../assets/images/card.svg' alt='Card'/> <h2>Add payment</h2></div>
      <div> <img src='../assets/images/present.svg' alt='Box'/> <h2>Receive boxes</h2></div>
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


@endsection
