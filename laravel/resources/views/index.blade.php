@extends('layouts.index')
@section('title', 'Monthly African Food Subscription Box| Boxeon')
@section('content')

    <div id="masthead">

        <aside class="centered asides call-out"><br>
            <img class="w300px center" src='{{ asset('../assets/images/logo.png') }}' alt='logo' />
            <h2 id="headline_h1" class="font-size-3-em">African Groceries Delivered To Your Doorstep</h2>
            <p class="centered center font-1-5-em">Home in a box. Subscribe to your favorite foods from home on a monthly schedule to save time and money. Cancel anytime.</p><br>
            <a href="/box/create" class="button uppercase">SUBSCRIBE NOW</a>
        </aside>
        <br><br>

    </div>
    <main id='margin-top-45-em'> <a id='whatis' href='#whatis'></a>

  @include("includes.works")

        <section class="block maxw1035 section margin-bottom-4-em">
            <div class="three-col-grid">
                <span></span>
                <div>
                <img class="float-left height60px" src="../assets/images/b.png" alt="Boxeon" />
                <a class="learn-more" href="/school/subscriptions">
                    <h2 class="display-inline">Learn more about Boxeon subscriptions<span class="material-icons">arrow_forward_ios</span></h2>
                </a>
            </div>
                <span></span>
            </div>
        </section>
        
        @include("includes.shop-products")

        <div class="center div-horizontal-rule"></div>


        <section id="creators-bar" class="max-width-1035 section">
            <h2 class="centered primary-color">BEST SELLERS</h2>
            <div id="as-seen-on" class="four-col-grid">
                <a class="center" href="https://www.youtube.com/channel/UCxjZrfFw9XpEsKZ5hOa4EZA"
                    target="_blank"><img class="creator-ego" src="../assets/images/plantain.png" alt="Allie" /></a>
                <a class="center" href="https://www.youtube.com/channel/UCxjZrfFw9XpEsKZ5hOa4EZA"
                    target="_blank"><img class="creator-ego" src="../assets/images/baobab.png"
                        alt="Allie" /></a>
                <a class="center" href="https://www.youtube.com/channel/UCxjZrfFw9XpEsKZ5hOa4EZA"
                    target="_blank"><img class="creator-ego" src="../assets/images/sugar-apple.png" alt="Allie" /></a>
                <a class="center hide" href="https://www.youtube.com/channel/UCxjZrfFw9XpEsKZ5hOa4EZA"
                    target="_blank"><img class="creator-ego" src="../assets/images/banana.png" alt="Allie" /></a>
            </div>
        </section>
    </main>

@endsection
