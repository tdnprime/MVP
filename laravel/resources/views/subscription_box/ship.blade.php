@extends('layouts.home')

@section('content')

<main class="fadein">
  <section id="left-aside"></section>

  @include('includes.ship-nav')

  <div id="subscriptions-stream">

      <div class="alert">
          <p class="material-icons">info</p>
          <p>Sorry, you don't presently have any outgoing boxes.</p>
      </div>

  </div>

  </aside><!-- THIS WAS OPENED ON LINE 5 !-->
  <section id="right-aside"></section>
</main>

@endsection
