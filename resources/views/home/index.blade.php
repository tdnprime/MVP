@extends('layouts.home')

@section('content')

<main class="fadein"><section id="left-aside"></section><aside id="panel">
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
      <ul id="tabs">
        <!--<li id="tab-surf"><a class="one-em-font" href="#"><span class="material-icons">surfing</span>Surf boxes</a></li>!-->
      <li id="tab-subscriptions"><a class="one-em-font" href="#"><span class="material-icons">subscriptions</span>Subscriptions</a></li>
      <li id="tab-tracking"><a class="one-em-font" href="#"><span class="material-icons">place</span>Tracking</a></li>
      </ul>
      </div>
  </div>
  <div class="alert">
<p class="material-icons">info</p>
<p>You don't have any subscriptions to show at this time.</p>

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
      
      </aside>
        
        <section id="right-aside"></section>  </main>

@endsection
