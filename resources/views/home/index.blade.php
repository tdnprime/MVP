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
      <a id="anchor-tab-subscriptions" class="button clearbtn" href="#"><span class="material-icons">subscriptions</span>Subscriptions</a><span class="break"></span>
      <a  id="anchor-tab-tracking" class="button clearbtn" href="#"><span class="material-icons">place</span>Tracking</a>
      </div>
  </div>

  
@include("includes.subscription-stream")


<div class="tab-content" data-id='anchor-tab-tracking' id="tracking-stream">
<div class="alert">
<p class="material-icons">info</p>
<p>You don't have any boxes to track.</p>
  </div>
</div>

      </aside>
      <aside></aside>

        <section id="right-aside"></section>  </main>

@endsection
