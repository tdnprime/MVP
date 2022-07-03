@extends('layouts.about')
@section('title', 'About Boxeon And Our Values')
@section('content')

    <main>
        <section id="banner" class="hide section wide bg-color-yellow">
            <h1 id="banner-slogan" class="centered ginormous"><i>Welcome!</i> You've reached the Home In A Box Movement</h1>
        </section>

        <section class='section wide hide'>     
            
            <div class="pitch w100per margin-bottom-4-em">
                <div class="w100per three-col-grid">
                    <img src="../assets/images/jollof-rice.png" alt="Draw Soup"/>
                    <div class="w800 centered">
                    <h1 class="text-3em">We started Boxeon to make it simple for the diaspora to enjoy the foods they love from home. But we quickly learned that Boxeon is much more than that. If you've ever had problems with time management and stress; if you've ever worried about the rampant carcinogenics in Western foods; if you've ever wished to experience more of your home culture; we're here for you.</h1>
                    <h1 class="text-3em">We're here for anyone and everyone who wants to consume from back home but whose time is valuable.</h1>
                    <h1 class="text-3em"> We're a service for diasporans with busy lives to automate and repatriate their grocery shopping.</h1>
                    <h1 class="text-3em">We believe that a culture of "work abroad, but consume from home" will one day spark industrial revolutions in our home countries. That's what Boxeon is about.</h1>
                    </div>
                    <img src="../assets/images/draw-soup.png" alt="Draw Soup"/>
                </div>
            </div>
            <section class="section wide margin-bottom-4-em bg-color-yellow">
            <h1 class="centered ginormous">OUR VALUES</h1>
            </section>
            <div id="team-wrapper" class="three-rows-grid">
                <div class="four-col-grid">
                    <span></span>
                    <img src="../assets/images/pledge-1.png" alt="Sustainability pledge">
                    <div>
                       
                        <p>To make it easy for you, our community, to work eco-friendly, sustainably-minded choices into your food consumption. We’re focused on three areas: Reducing waste, Recyclability. and Reusability.</p>
                    </div>
                    <span></span>
                </div>
                <div class="four-col-grid">
                    <span></span>
                    <img src="../assets/images/pledge-2.png" alt="Women's pledge">
                    <div>
                        <p>We’re committed to lifting up and celebrating women in business to honor their accomplishments. We intentionally partner with women-founded, owned, and run food brands, making it easy for our community to shop with their values while finding products that suit their needs. We engage in opportunities to speak to and mentor women in all stages and types of careers. We partner with women-founded, owned, owned and run companies and non-profits with women-centered missions.</p>               
                    </div>
                    <span></span>
                </div>
    
                <div class="four-col-grid">
                    <span></span>
                    <img src="../assets/images/pledge-3.png" alt="Pan African pledge">
                    <div>
                        <p>To make it easy for our community to experience the best Afro food products, we extend our search for the best quality food products throughout various African countries, the Caribbean, and the Afro Americas.</p>
                    </div>
                    <span></span>
                </div>
            </div>

        </section>
    </main>

@endsection
