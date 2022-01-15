@extends('layouts.home')
@section('title', 'Home')
@section('content')

<main class="fadein"><section id="left-aside">
</section>

<aside id="panel">
  <div class="margin-top-4-em vertical-align">
      <div id="tabs-wrapper">
      <a id="anchor-tab-subscriptions" class="button clearbtn" href="#"><span class="material-icons">subscriptions</span>Subscriptions</a><span class="break"></span>
      <a  id="anchor-tab-tracking" class="button clearbtn" href="#"><span class="material-icons">place</span>Tracking</a>
      </div>
  </div>
  
@include("includes.subscription-stream")

@include("includes.tracking")

      </aside>
      <aside></aside>
        <section id="right-aside"></section>  </main>

@endsection
