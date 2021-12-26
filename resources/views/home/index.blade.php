@extends('layouts.home')

@section('content')

<main class="fadein"><section id="left-aside">
</section>

<aside id="panel">
    <!--<div id="sentiment-survey" class="bg-yellow"><h1 class="secondary-color">How do you feel about Boxeon?</h1>
    <div class="four-col-grid">
    <span class="material-icons">sentiment_neutral</span>
    <span class="material-icons">sentiment_satisfied</span>
      <span class="material-icons">sentiment_very_satisfied</span>
          <span class="material-icons">sentiment_dissatisfied</span>
    </div>
    </div>!-->
  <div class="margin-top-4-em vertical-align">
      <div id="tabs-wrapper">
      <a id="anchor-tab-subscription" class="button clearbtn" href="#"><span class="material-icons">subscriptions</span>Subscriptions</a>
      <a  id="anchor-tab-tracking" class="button clearbtn" href="#"><span class="material-icons">place</span>Tracking</a>
      </div>
  </div>
  <div id="subscriptions-stream">
  <div class="alert">
<p class="material-icons">info</p>
<p>You don't presently have subscriptions to show.</p>
  </div>
</div>
<div id="tracking-stream">
<div class="alert">
<p class="material-icons">info</p>
<p>You don't have any boxes to track.</p>
  </div>
</div>
  <!--<div id="home-videos-wrapper"><div id="$id">
        <div class="playbtn-wrapper">
        <img src="http://img.youtube.com/vi/LJszeiEyXMk/mqdefault.jpg">
        <img id="play-video" data-shipping='$cost' data-video-id="LJszeiEyXMk" class="playbtn" src="../assets/images/playbtn.png" alt="Play video">
        </div>
          <br>
        <p>Prototype Creator</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor id ligula et tincidunt.</p>
        </div></div>!-->
      
      </aside><!-- THIS WAS OPENED ON LINE 5 !-->
      <aside></aside>
        
        <section id="right-aside"></section>  </main>

@endsection
