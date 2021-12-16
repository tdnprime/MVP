@extends('layouts.home')

@section('content')

<main class="fadein"><section id="left-aside"></section><aside id="panel">

      <div class="margin-top-4-em vertical-align">
      <div id="tabs-wrapper">
      <ul id="tabs"><li id="tab-surf"><a class="one-em-font" href="#"><span class="material-icons">surfing</span>Surf boxes</a></li>
      <li id="tab-subscriptions"><a class="one-em-font" href="#"><span class="material-icons">subscriptions</span>Subscriptions</a></li>
      <li id="tab-tracking"><a class="one-em-font" href="#"><span class="material-icons">place</span>Tracking</a></li>
      </ul>
      </div>
  </div>
  <div class="alert"><p><span class="material-icons">info</span>There are no surfable boxes at this time.  Please try again later.</p></div>
  {{-- 
  <div id="home-videos-wrapper">
      <div id="52">
        <div class="playbtn-wrapper">
        <img src="http://img.youtube.com/vi/VVilOqCLVPc/mqdefault.jpg">
        <img id="play-video" data-video-id="VVilOqCLVPc" class="playbtn" src="../assets/images/playbtn.png" alt="Play video">
        </div>
          <br>
        <p>Jane Doe</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor id ligula et tincidunt. </p>
        </div></div><div id="home-videos-wrapper"><div id="48">
        <div class="playbtn-wrapper">
        <img src="http://img.youtube.com/vi/-jn5ttblE9M/mqdefault.jpg">
        <img id="play-video" data-video-id="-jn5ttblE9M" class="playbtn" src="../assets/images/playbtn.png" alt="Play video">
        </div>
          <br>
        <p>Kelly Stamps</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor id ligula et tincidunt.</p>
        </div>
    </div>
    </aside>
    <section id="right-aside"></section> --}}
    </main>
@endsection
