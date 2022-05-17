@extends('layouts.index')
@section('title', 'Boxeon Ghana Beyond Aid Subscription Box')
@section('content')

    <main class='boxes' id='margin-top-45-em'>
        <div class='maxw1036 margin-auto'>
            <section id="boxes-panel" class="section margin-top-4-em">
                <div class="div-limited-editions-panel two-col-grid">
                    <div class="secinner">
                        <div class="slideshow">
                            <div class='slideshow-main-image'>
                                <img src="../assets/images/shampoo.png" alt='Black soap' />
                            </div>
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

                    <div>
                        <p class="red-tag">A $63 VALUE</p>
                        <h2>Africa to the world box</h2>
                        <div class="stars-grid">
                            <span class="material-icons">star</span>
                            <span class="material-icons">star</span>
                            <span class="material-icons">star</span>
                            <span class="material-icons">star</span>
                            <span class="material-icons">star</span>
                            <a id='#jumptoreviews' href='' class='reviews-jump-to underline'># reviews</a>
                        </div>
                        <p>Enjoy organic African superfoods and products, repatriate your dollars,
                            build trade, and spark an industrial revolution. This box consist of daily essential
                            products seen on the Wode Maya and Vanessa Kanbi YouTube channels.<span><b>&nbsp;<a class="one-em-font underline" href="#">Read more</a></b></span>

                        </p>
                    
                        <p>Ships from the United States.</p>
                        <form action="/cart" method="post">
                            @csrf
                            <select>
                                <option>$22/month - billed monthly for 1 month</option>
                            </select>
                            <input type="submit" value="ADD TO CART">
                        </form>
                    </div>

                </div>
            </section>
            <section class='reviews-section'>
                <h2 class='center'>Reviews</h2>
                <div id="ratings-overview" class='four-col-grid'>
                    <span></span>
                    <div>
                        <p class='centered'>AVERAGE RATING</p>
                        <div id="starsv2" class="stars-grid">
                            <span class="material-icons">star</span>
                            <span class="material-icons">star</span>
                            <span class="material-icons">star</span>
                            <span class="material-icons">star</span>
                            <span class="material-icons">star</span>
                            
                        </div>
                        <p class="centered"># Reviews</p>
                    </div>
                    <div>
                        <ul id="ratings-breakdown">
                            <li><span class="num-starts">5 stars</span><span class="stars-bar red"></span><span class="stars-percent">100%</span></li>
                            <li><span class="num-starts">4 stars</span><span class="stars-bar grey"></span><span class="stars-percent">0%</span></li>
                            <li><span class="num-starts">3 stars</span><span class="stars-bar grey"></span><span class="stars-percent">0%</span></li>
                            <li><span class="num-starts">2 stars</span><span class="stars-bar grey"></span><span class="stars-percent">0%</span></li>
                            <li><span class="num-starts">1 star</span><span class="stars-bar grey"></span><span class="stars-percent">0%</span></li>

                        </ul>
                    </div>
                    <span></span>
                </div>
                <div class="div-wide-horizontal-rule center"></div>
                <div class="two-col-grid">
                    <img src="../assets/images/user.svg">
                    <p>Review...</p>
                </div>
                <div class="div-wide-horizontal-rule center"></div>

                <button class="button center">WRITE A REVIEW</button>
            </section>

        </div>
    </main>


@endsection
