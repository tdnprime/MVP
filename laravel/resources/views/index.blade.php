@extends('layouts.index')
@section('title', 'Boxeon.com Monthly African Subscription Boxes')
@section('content')
    <div id="masthead">
        <div id="banner" class="center"></div>
        <aside class="centered asides call-out">
            <h2 class="font-size-3-em">Develop Africa without leaving your couch</h2>
            <p class="centered center font-1-5-em">An effortless, simple way to build Africa. We’ll send you 7 daily essential products manufactured in Africa to help spark industrial revolutions on the continent. It’s really that easy, we promise.</p>
        </aside>
        <br><br>
    </div>
    <main id='margin-top-45-em'> <a id='whatis' href='#whatis'></a>
        <section class="section margin-bottom-4-em">
            <div class="module">
                <h2 class='centered'>Choose your subscription:<h2>
                        <h2 class='centered'>Monthly Billing</h2>
                        <div class=" pricing-panel">
                            <div class="pricing">
                                <div class='plans-pricing-header'><span class='plan-header-text'>monthly plan</span></div>
                                <h2>$22/month</h2>
                                <span class='parens'>(billed monthly)</span>
                                <p>Committing to 1 month </p>
                                <button class="button">GET YOUR BOX</button>
                            </div>
                            <div class="pricing">
                                <div class='plans-pricing-header'><span class='plan-header-text'>3 month plan</span></div>
                                <h2>$22/month</h2>
                                <span class='parens'>(billed monthly)</span>
                                <p>Committing to 3 months <br></p>
                                <button class="button">GET YOUR BOX</button>
                            </div>
                            <div class="pricing">
                                <div class='plans-pricing-header'><span class='plan-header-text'>6 month plan</span></div>
                                <h2>$21/month</h2>
                                <span class='parens'>(billed monthly)</span>
                                <p>Committing to 6 months <br></p>
                                <button class="button">GET YOUR BOX</button>
                            </div>
                            <div class="pricing">
                                <div class='plans-pricing-header'><span class='plan-header-text'>12 month plan</span></div>
                                <h2>$20/month</h2>
                                <span class='parens'>(billed monthly)</span>
                                <p>Committing to 12 months</p>
                                <button class="button">GET YOUR BOX</button>
                            </div>
                        </div>
            </div>
            <div class="module">
                <h2 class='centered'>Prepaid Plans</h2>
                <div class="pricing-panel-prepaid">
                    <div class="pricing">
                        <div class='plans-pricing-header'><span class='plan-header-text'>3 month plan</span></div>
                        <h2>$45</h2>
                        <p>Billed every 3 months at $45 </p>
                        <p>Committing to 3 months </p>
                        <button class="button">GET YOUR BOX</button>
                    </div>
                    <div class="pricing">
                        <div class='plans-pricing-header'><span class='plan-header-text'>6 month plan</span></div>
                        <h2>$84</h2>
                        <p>Billed every 6 months at $84</p>
                        <p>Committing to 6 months</p>
                        <button class="button">GET YOUR BOX</button>
                    </div>
                    <div class="pricing">
                        <div class='plans-pricing-header'><span class='plan-header-text'>12 month plan</span></div>
                        <h2>$156</h2>
                        <p>Billed every 6 months at $156</p>
                        <p>Committing to 12 months</p>
                        <button class="button">GET YOUR BOX</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="wide section padding-top-6-em">
            <div class="new-section-inner-grid">
                <span class="hide"></span>
                <img src="../assets/images/creator.png" alt='Rock' />
                <div class="secinner">
                    <h2 class="white">Hey Creators!</h2>
                    <p class="w600 white">If you'd like to promote our brand, make us an offer.</p>
                <br>
                    <a href="/apply" class="button clearbtn">MAKE OFFER</a>
                </div>
                <span class="hide"></span>
            </div>
        </section>
        <section id="boxes-panel" class="section margin-top-4-em">
            <div class="three-rows-grid">
                <div class="div-limited-editions-panel two-col-grid">
                    <img src="../assets/images/medium-product-img.png" alt='products' />
                    <div>
                        <h2>Organic African Superfood box</h2>
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
                        <h2>African Child Skincare Kit</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                        <a href="/box/ghana" class='button'>GET IT HERE!</a>
                    </div>
                </div>
                <div class="div-limited-editions-panel two-col-grid">
                    <img src="../assets/images/medium-product-img.png" alt='products' />
                    <div>
                        <h2>Traditional African Body Routine box</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
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
                    target="_blank"><img class="creator-ego" src="../assets/images/african-tigress.png" alt="Allie" /></a>
                <a class="center" href="https://www.youtube.com/channel/UCxjZrfFw9XpEsKZ5hOa4EZA"
                    target="_blank"><img class="creator-ego" src="../assets/images/vanessa-kanbi.png" alt="Allie" /></a>
                <a class="center" href="https://www.youtube.com/channel/UCxjZrfFw9XpEsKZ5hOa4EZA"
                    target="_blank"><img class="creator-ego" src="../assets/images/miss-trudy.png" alt="Allie" /></a>
            </div>
        </section>
    </main>

@endsection
