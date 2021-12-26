@extends('layouts.home')

@section('content')

<main class="fadein">
    <section id="left-aside"></section>
   
<aside id="panel">
   
  <div class="margin-top-4-em vertical-align">
      <div id="tabs-wrapper">
      <a id="anchor-tab-subscription" class="button clearbtn" href="#"><span class="material-icons">subscriptions</span>Outgoing</a>
      <a id="anchor-tab-subscription" class="button clearbtn" href="#"><span class="material-icons">subscriptions</span>Incoming</a>
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

      
      </aside><!-- THIS WAS OPENED ON LINE 5 !-->
    <section id="right-aside"></section>
</main>
@endsection
