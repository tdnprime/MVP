@extends('layouts.home')

@section('content')

<main class="fadein">
    <section id="left-aside"></section>
   
<aside id="panel">
   
  <div class="margin-top-4-em vertical-align">
      <div id="tabs-wrapper">
      <a id="anchor-tab-subscriptions" class="button clearbtn" href="#"><span class="material-icons">outbox</span>Outgoing</a>
      <a id="anchor-tab-incoming" class="button clearbtn" href="#"><span class="material-icons">inbox</span>Incoming</a>
      <a  id="anchor-tab-tracking" class="button clearbtn" href="#"><span class="material-icons">place</span>Tracking</a>
      </div>
  </div>
  <div class="tab-content" data-id='anchor-tab-subscriptions' id="subscriptions-stream">
  <div class="alert">
<p class="material-icons">info</p>
<p>You don't presently have any outgoing boxes.</p>
  </div>
</div>
<div class="tab-content" data-id='anchor-tab-incoming' id="incoming-stream">
<div class="alert">
<p class="material-icons">info</p>
<p>You don't have any new subscriptions.</p>
  </div>
</div>
<div class="tab-content" data-id='anchor-tab-tracking' id="tracking-stream">
<div class="alert">
<p class="material-icons">info</p>
<p>There are no boxes to track.</p>
  </div>
</div>

      
      </aside><!-- THIS WAS OPENED ON LINE 5 !-->
    <section id="right-aside"></section>
</main>
@endsection
