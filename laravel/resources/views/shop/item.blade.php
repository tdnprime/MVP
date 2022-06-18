@extends('layouts.index')
@section('title', 'Boxeon.com {{$product[0]->name}}')
@section('content')

<main class='boxes' id='margin-top-45-em'>
    <div class='maxw1036 margin-auto'>
        <section id="boxes-panel" class="section margin-top-4-em">
            <div class="div-limited-editions-panel two-col-grid">
                <div class="secinner">
                    <div class="slideshow">
                        <div class='slideshow-main-image'>
                            <img src="../assets/images/{{$product[0]->img}}" alt='{{$product[0]->name}}' />
                        </div>
                    </div>
                </div>

                <div>
                    <p class="red-tag">SUBSCRIBE & SAVE</p>
                    <h2>{{$product[0]->name}}</h2>
                   
                    @include("includes.stars")

                    <p class="green">{{$product[0]->in_stock}} In Stock.</p>
                    <p>{{$product[0]->description}}<span><b>&nbsp;<a class="one-em-font underline" href="#">Read more</a></b></span>

                    </p>
                
                    <p>Ships from the United States.</p>
                    <form action="/cart" method="post">
                    
                        <select class="select-plan margin-top-zero" name="quantity">
                            <option selected value="1">Qty: 1</option>
                            <option value="2">Qty: 2</option>
                            <option value="3">Qty: 3</option>
                            <option value="4">Qty: 4</option>
                            <option value="5">Qty: 5</option>
                            <option value="6">Qty: 6</option>
                            <option value="7">Qty: 7</option>
                        </select>&nbsp;&nbsp;
                        <select class="select-plan margin-top-zero">
                            <option invalid>Choose price/plan</option>
                            <option>${{$product[0]->price}} Every month</option>
                        </select>
                        <br>
                        <br>
                        <input type="submit" value="SUBSCRIBE NOW">&nbsp;&nbsp;
                    </form>
                </div>

            </div>
        </section>
        <section class='reviews-section'>
            <h2 class='center'>Reviews</h2>
            <br>
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
                <div class="three-col-grid reviewer-grid">
                <img src="../assets/images/user.svg">
                <b><p>User Name</p></b>
                <div class="stars-grid">
                    <span class="material-icons">star</span>
                    <span class="material-icons">star</span>
                    <span class="material-icons">star</span>
                    <span class="material-icons">star</span>
                    <span class="material-icons">star</span>
                </div>
                </div>
                <p>Review...</p>
            </div>
            <div class="div-wide-horizontal-rule center"></div>

            <button id="show-review-form" class="button center">WRITE A REVIEW</button>
            <form id="form-reviews" action='/review/submit' method='post'>
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-75">
                      <textarea name="review" placeholder="Write a review"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type='submit' value='Submit review'>
                    </div>
                </div>
            </form>
        </section>

    </div>
</main>


@endsection

