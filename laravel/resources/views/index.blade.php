@extends('layouts.index')
@section('title', 'Boxeon.com Support Causes With Monthly Subscription Boxes')
@section('content')

    <div id="masthead">
        <div id="banner" class="center"></div>
        <aside class="centered asides">
            <h2 class="gin">Support social causes with subscription boxes</h2>
            <p class="centered center font-1-5-em">Our subscription boxes are curated to allow subscribers to replace the
                daily essential products they purchase from faceless corporations with products that support their favorite
                cause.</p>
        </aside>

    </div>


    <main id='margin-top-45-em'> <a id='whatis' href='#whatis'></a>
        <section class="section margin-bottom-4-em">
            <div class="center">
                <h2 class='centered'>Choose your subscription:<h2>
                        <h2 class='centered'>Monthly billing</h2>
                        <div class="four-col pricing-panel">
                            <div class="pricing">
                                <div class='plans-pricing-header'><span class='plan-header-text'>monthly plan</span></div>
                                <h2>$20/month</h2>
                                <span class='parens'>(billed monthly)</span>
                                <p>Committing to 1 month </p>
                                <button class="button">GET YOUR BOX</button>
                            </div>
                            <div class="pricing">
                                <div class='plans-pricing-header'><span class='plan-header-text'>3 month plan</span></div>
                                <h2>$20/month</h2>
                                <span class='parens'>(billed monthly)</span>
                                <p>Committing to 3 months <br></p>
                                <button class="button">GET YOUR BOX</button>
                            </div>
                            <div class="pricing">
                                <div class='plans-pricing-header'><span class='plan-header-text'>6 month plan</span></div>
                                <h2>$19/month</h2>
                                <span class='parens'>(billed monthly)</span>
                                <p>Committing to 6 months <br></p>
                                <button class="button">GET YOUR BOX</button>
                            </div>
                            <div class="pricing">
                                <div class='plans-pricing-header'><span class='plan-header-text'>12 month plan</span></div>
                                <h2>$18/month</h2>

                                <span class='parens'>(billed monthly)</span>
                                <p>Committing to 12 months</p>
                                <button class="button">GET YOUR BOX</button>
                            </div>

                        </div>
            </div>
            <div class="center">
                <h2 class='centered'>Prepaid plans</h2>
                <div class="three-col pricing-panel">
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
                <span></span>
                <img src="../assets/images/celebrate.svg" alt='Rock' />
                <div class="secinner">
                    <h2 class="white">Hey Creators!</h2>
                    <p class="w600 white">If you're a creator and would like help with your social cause, we want to hear from you.</p>
                    <a href="/catalog/" class="button clearbtn">Learn more</a>
                </div>
                <span></span>
            </div>
            </div>
        </section>
        <section class="section margin-top-4-em">
            <div class="three-rows-grid">

                <div class="div-limited-editions-panel two-col-grid">
                    <div>
                        <h2>Limited box: Slava Ukraine</h2>
                        <p>Dry, limp hair, be gone! It’s time to give your locks the TLC they need. From shine-inducing
                            masks to nourishing scalp treatments to rich shampoos, this kit is mane magic in a box. A great
                            gift for every hair type, including your own.</p>
                            <a href="/catalog/" class='button'>GET IT HERE!</a>
                    </div> 
                    <img src="../assets/images/medium-product-img.png" alt='products' />
                </div>
                <div class="div-limited-editions-panel two-col-grid">
                  <img src="../assets/images/medium-product-img.png" alt='products' />
                    <div>
                        <h2>Limited box: Africa to the world</h2>
                        <p>Dry, limp hair, be gone! It’s time to give your locks the TLC they need. From shine-inducing
                            masks to nourishing scalp treatments to rich shampoos, this kit is mane magic in a box. A great
                            gift for every hair type, including your own.</p>
                            <a href="/catalog/" class='button'>SHOP THE BOX</a>
                    </div>
                    
                </div>
                <div class="div-limited-editions-panel two-col-grid">
                    <div>
                        <h2>Limited box: Ghana Beyond Aid</h2>
                        <p>Dry, limp hair, be gone! It’s time to give your locks the TLC they need. From shine-inducing
                            masks to nourishing scalp treatments to rich shampoos, this kit is mane magic in a box. A great
                            gift for every hair type, including your own.</p>
                            <a href="/catalog/" class='button'>SHOP THE BOX</a>

                    </div> <img src="../assets/images/medium-product-img.png" alt='products' />
                </div>
            </div>

        </section>
        <div class="div-horizontal-rule center"></div>
        <section class="section">
          <h2 class="centered">Subscribe via a creator</h2>
          <a class="center" href="/allie"><img class="creator-ego" src="../assets/images/allie.webp" alt="Allie"/></a>
        </section>
    </main>


@endsection
