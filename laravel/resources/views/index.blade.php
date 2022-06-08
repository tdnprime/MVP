@extends('layouts.index')
@section('title', 'Meal Kit Delivery Service | Boxeon')
@section('content')

    <div id="masthead">

        <aside class="centered asides call-out"><br>
            <img class="center" src="../assets/images/logo.png" alt="BOXEON" />
            <h2 id="headline_h1" class="font-size-3-em">Get 16 Free foods + 3 Surprise Gifts</h2>
            <p class="centered center font-1-5-em">An effortless way to enjoy the African superfoods you love from home. We'll send you, your choice of African foods at a recurring schedule convinient to you.</p><br>
            <a href="/box/create" class="button uppercase">Personalize Your Box</a>
        </aside>
        <br><br>
    </div>
    <main id='margin-top-45-em'> <a id='whatis' href='#whatis'></a>
        <section class="section margin-bottom-4-em">

            <div class="module">

                <h2 class='centered'>Dinner, Delivered. How it works.</h2><br>

                <div class="three-col-grid">
                    <div>
                        <h3>More Choice, Less Boredom</h3>
                    </div>
                    <div>
                        <h3>Faster Recipes, Less Prep Work</h3>
                    </div>
                    <div>
                        <h3>Flexible Plans, Less Hassle</h3>
                    </div>

                </div>
        </section>
        <section class="wide section padding-top-6-em">
            <h2 class='centered margin-bottom-0'>Be first to know when we launch. Join our waiting list.</h2>
            <div class="new-section-inner-grid margin-bottom-2-em">
                <span class="503-hide"></span>
                <div>
                    <form id="mailing-list-form" action="/pmf/email" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-75 two-col-grid">
                                <input type="email" placeholder="Primary email" name="email">
                                <input type='submit' value="JOIN NOW">
                            </div>
                        </div>

                    </form>
                </div>
                <span class="hide"></span>
            </div>
        </section>
        <section id="boxes-panel" class="section margin-top-4-em">
            <div class="three-rows-grid">
                <div class="div-limited-editions-panel two-col-grid">
                    <img src="../assets/images/medium-product-img.png" alt='products' />
                    <div>
                        <h2>Limited-Edition box: Africa To The World</h2>
                        <p>Enjoy organic African superfoods and products, repatriate your dollars,
                            build trade, and spark an industrial revolution. This box consist of daily essential
                            products seen on the Wode Maya and Vanessa Kanbi YouTube channels.

                        </p>
                        <a href="/box/africa" class='button'>SHOP THE BOX</a>
                    </div>
                </div>
                <div class="div-limited-editions-panel two-col-grid">
                    <img class="flip-right" src="../assets/images/medium-product-img.png" alt='products' />
                    <div class="flip-left">
                        <h2>limited-Edition Box: African Child Skincare Kit</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. </p>
                        <a href="/box/ghana" class='button'>GET IT HERE!</a>
                    </div>
                </div>
                <div class="div-limited-editions-panel two-col-grid">
                    <img src="../assets/images/medium-product-img.png" alt='products' />
                    <div>
                        <h2>Limited-Edition Box: Traditional African Body Routine</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <a href="/box/seafood" class='button'>SHOP THE BOX</a>
                    </div>
                </div>
            </div>
        </section>
        <div class="div-horizontal-rule center"></div>
        <section id="creators-bar" class="max-width-1035 section">
            <h2 class="centered">As Seen On</h2>
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
