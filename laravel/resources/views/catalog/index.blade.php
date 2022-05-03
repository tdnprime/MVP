@extends('layouts.index')
@section('title', 'Best sustainable, exotic, useful products - subscription box')
@section('content')
    <div id="masthead">

        <p class="centered text-heading-label">SUPPORT YOUR CAUSE WITH</p>
        <h1 class="centered ginormous">Impactful, useful subscription boxes</h1>

        <img class='w600 center' src='../assets/images/shampoo.png'>

        <div id='product-categories' class='center'>

            <a href="#whatis" class='primary-color underline'> Learn more </a>
        </div>

    </div>
    <main class='boxes' id='margin-top-45-em'> <a id='whatis' href='#whatis'></a>
        <aside class="asides">
            <img id="image-raised-fist" class="center" src="../assets/images/raised-fist.svg" alt="Raised fist" />

            <h1 class="extra-large-font darkblue">Boxes of solidarity</h1>
            <p class="centered center font-1-5-em">Our boxes are curated to allow subscribers to replace the
                products they purchase from faceless corporations with products that support a creator's favorite cause.</p>
            <br>
        </aside>

        <section class="section padding-top-6-em">
            <div class="section-inner-grid"> <img class='box-mockup' src="../assets/images/ukraine-box-mockup-large.png"
                    alt='Rock' />
                <div class="secinner">

                    <div class="slideshow">
                        <div class='slideshow-main-image'>
                            <img src="../assets/images/shampoo.png" alt='Black soap' />
                        </div>
                     
                    </div>

                    <h2 class="extra-large-font">Starts with samples</h2>
                    <p>We pay creators a flat monthly salary of $1000 per month with a 12 month contract. So this is a
                        remote job you can rely on.</p>
                </div>
                <div class='slideshow-navigation'>
                    <img id='image-previous-arrow' src="../assets/images/arrow.svg" alt='Previous' />
                    <div class="image-products-thumbs">
                        <ul class='ul-products-thumbs'>
                            <li><img src="../assets/images/blacksoap-thumb.png" alt='Black soap' /></li>
                            <li><img src="../assets/images/blacksoap-thumb.png" alt='Black soap' /></li>
                            <li><img src="../assets/images/blacksoap-thumb.png" alt='Black soap' /></li>
                            <li><img src="../assets/images/blacksoap-thumb.png" alt='Black soap' /></li>
                            <li><img src="../assets/images/blacksoap-thumb.png" alt='Black soap' /></li>
                            <li><img src="../assets/images/blacksoap-thumb.png" alt='Black soap' /></li>
                        </ul>
                    </div>
                    <img id='image-next-arrow' src="../assets/images/arrow.svg" alt='Next' />

                </div>
            </div>
            </div>
        </section>
        <section class="section">
            <div class="alt-section-inner-grid">
                <div class="secinner">
                    <h2 class="extra-large-font">Upgrades to full box</h2>
                    <p>Boxeon will donate 10% of the profits made on your subscription box to your favorite charitable
                        cause. You will have the option of doing the actual giving on camera. In other words, Boxeon will be
                        great for your brand.</p>
                </div>
                <img class='box-mockup' src="../assets/images/ukraine-box-mockup-larger.png" alt="Boy" />

            </div>
        </section>
        <section class="section">
            <div class="alt-section-inner-grid">
                <img class='box-mockup' src="../assets/images/africa-box-mockup-large.png"
                alt='Rock' />
                <div class="secinner">
                    <h2 class="extra-large-font">Africa to the world</h2>
                    <p>Only two YouTubers sell subscription boxes as of 2021. But there's a whopping 951k monthly Youtube
                        searches for the phrase "subscription box." Source: TubeBuddy.</p>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="alt-section-inner-grid">
                <div class="secinner">
                    <h2 class="extra-large-font">Year of charity</h2>
                    <p>Because we're based in Silicon Valley, we're able to ship with every global shipping company.
                        Moreover, we've already secured for your buyers up to 90% off on shipping.</p>
                </div>
                <img src="../assets/images/charity-box-mockup-large.png" alt="Charity box" />
            </div>
        </section>

        <section class="section">
            <div class="alt-section-inner-grid">
                <img src="../assets/images/blm-box-mockup-large.png" alt="BLM box" />
                <div class="secinner">
                    <h2 class="extra-large-font">Black lives matter</h2>
                    <p>The Boxeon team will work closely with you to ensure your subscription box is a success for both of
                        us.</p>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="alt-section-inner-grid">
                <div class="secinner">
                    <h2 class="extra-large-font">Black love</h2>
                    <p>Our financial transactions are conducted by secure services such as Square, World Remit, and CashApp.
                    </p>
                </div>
                <img src="../assets/images/black-love-box-mockup-large.png" alt="General Data Protection Regulation" />

            </div>
        </section>
        <section class="section margin-bottom-10-em">
            <div class="alt-section-inner-grid">
                <img src="../assets/images/custom-box-mockup-large.png" alt="Shoppers" />
                <div class="secinner">
                    <h2 class="extra-large-font">Custom branding</h2>
                    <p>We use a subscription model that's already proven in the marketplace by billion dollar companies. For
                        a live preview, check out Allie's <a href='https://boxeon.com/allie'
                            class='primary-color underline one-em-font'>subscription box</a>.</p>
                </div>
            </div>
        </section>

        <br>
        <h2 class="centered">How it works</h2>
        <div id="how-it-works" class="four-col-grid">
            <div> <img src="../assets/images/computer.svg" alt="Computer" />
                <h2>Survey fans</h2>
            </div>
            <div> <img src="../assets/images/box.svg" alt="Box" />
                <h2>Plan box</h2>
            </div>
            <div> <img src="../assets/images/camera.svg" alt="Camera" />
                <h2>Share box</h2>
            </div>
            <div> <img src="../assets/images/growth.svg" alt="Growth" />
                <h2>Earn</h2>
            </div>
        </div>
        <section class='section'> <br>
            <div class="centered margin-bottom-10-em">
                <h1 class="extra-large-font darkblue">It's that simple</h1>
                <br>
                <a class="button" href="/apply/"> Apply now </a>
            </div>
        </section>
    </main>


@endsection
