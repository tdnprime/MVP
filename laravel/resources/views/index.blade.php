@extends('layouts.index')
@section('title', 'Monthly African Food Subscription Box| Boxeon')
@section('content')

    <div id="masthead">

        <aside id="move-down" class="centered asides call-out"><br>
            <h2 id="headline_h1" class="font-size-3-em">Get 16 Free Foods + 3 Surprise Gifts</h2>
            <p class="centered center font-1-5-em">An effortless way to enjoy imported African foods. Subscribe to your choice of foods and get 16 free foods + 3 surprise gifts.</p><br>
            <a href="/box/create" class="button uppercase">Personalize Your Box</a>
        </aside>
        <br><br>

    </div>
    <main id='margin-top-45-em'> <a id='whatis' href='#whatis'></a>

  @include("includes.works")

        <section class="block maxw1035 section margin-bottom-4-em">
            <div class="three-col-grid">
                <span class="hide material-icons font-size-30px">star</span>
                <a href="/school/subscriptions">
                    <h2>Learn more about Boxeon subscriptions<span class="material-icons">arrow_forward_ios</span></h2>
                </a>
                <span></span>
            </div>
        </section>
        @include("includes.shop-products")

        <section id="creators-bar" class="max-width-1035 section">
            <h2 class="centered">AS SEEN ON</h2>
            <div id="as-seen-on" class="four-col-grid">
                <a class="center" href="https://www.youtube.com/channel/UCxjZrfFw9XpEsKZ5hOa4EZA"
                    target="_blank"><img class="creator-ego" src="../assets/images/tayo-aina.png" alt="Allie" /></a>
                <a class="center" href="https://www.youtube.com/channel/UCxjZrfFw9XpEsKZ5hOa4EZA"
                    target="_blank"><img class="creator-ego" src="../assets/images/african-tigress.png"
                        alt="Allie" /></a>
                <a class="center" href="https://www.youtube.com/channel/UCxjZrfFw9XpEsKZ5hOa4EZA"
                    target="_blank"><img class="creator-ego" src="../assets/images/vanessa-kanbi.png" alt="Allie" /></a>
                <a class="center hide" href="https://www.youtube.com/channel/UCxjZrfFw9XpEsKZ5hOa4EZA"
                    target="_blank"><img class="creator-ego" src="../assets/images/miss-trudy.png" alt="Allie" /></a>
            </div>
        </section>
    </main>

@endsection
