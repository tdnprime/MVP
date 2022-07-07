@extends('layouts.index')
<title>Boxeon.com <?php echo 'Shop ' . $product[0]->name; ?> | Best African Market Online</title>
@section('content')
    <main>
        <section class="card maxw1036 section">
            @include('includes.category-nav')
            <div id="product-stream" class="fit-content margin-auto two-col-grd">

                <img class="image-lg-product" src="../assets/images/products/{{ $product[0]->img }}" alt='{{ $product[0]->name }}' />

                <div class="w70per margin-auto">
                    <p class="red-tag">SUBSCRIBE & SAVE</p>
                    <h2>{{ $product[0]->name }}</h2>
                    @include('includes.stars')
                    <p class="green">In Stock</p>
                    <p class="w300">{{ $product[0]->description }}</p>
                    <h4 class="uppercase">Product details</h4>
                    <p>Weight: {{ $product[0]->weight }} pound(s)</p>
                    </p>
                    <p class="text-red">Original price: ${{ $product[0]->price + 3 }}</p>
                    <form class="form-plan" action="/cart" method="post">
                        <select class="select-plan margin-top-zero" name="quantity">
                            <option invalid>Select quantity</option>
                            <option selected value="1">Qty: 1</option>
                            <option value="2">Qty: 2</option>
                            <option value="3">Qty: 3</option>
                            <option value="4">Qty: 4</option>
                            <option value="5">Qty: 5</option>
                            <option value="6">Qty: 6</option>
                            <option value="7">Qty: 7</option>
                        </select>
                        <select class="select-plan margin-top-zero">
                            <option invalid>Select Subscription</option>
                            <option value="1" selected>${{ $product[0]->price }} - Every month</option>
                            <option value="2">${{ $product[0]->price + 1 }} - Every 2 months</option>
                            <option value="3">${{ $product[0]->price + 2 }} - Every 3 months</option>
                            <option value="0">${{ $product[0]->price + 3 }} - One-time purchase</option>
                        </select>
                    </form>
                    <button data-name="{{ $product[0]->name }}" data-plan="1" data-img="{{ $product[0]->img }}"
                        data-id="{{ $product[0]->id }}" data-price="{{ $product[0]->price }}" class="cart-add"
                        class="button">SUBSCRIBE NOW</button>
                    <div class="two-col-grid charitable-grid">
                        <img class="w40px" src="../assets/images/girl.jpg" alt="Orphan Girl" />
                        <a href="/school/subscriptions" class="primary-color one-em-font">
                            <p>Learn about Boxeon subscriptions</p>
                        </a>
                    </div>
                </div>
            </div>
            {{-- <h2 class='center margin-top-4-em'>Customer Reviews</h2>
                <br>
                <div id="ratings-overview" class='four-col-grid display-none'>
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
                        <ul class="one-em-font" id="ratings-breakdown">
                            <li><span class="num-starts">5 stars</span><span class="stars-bar red"></span><span
                                    class="stars-percent">100%</span></li>
                            <li><span class="num-starts">4 stars</span><span class="stars-bar grey"></span><span
                                    class="stars-percent">0%</span></li>
                            <li><span class="num-starts">3 stars</span><span class="stars-bar grey"></span><span
                                    class="stars-percent">0%</span></li>
                            <li><span class="num-starts">2 stars</span><span class="stars-bar grey"></span><span
                                    class="stars-percent">0%</span></li>
                            <li><span class="num-starts">1 star</span><span class="stars-bar grey"></span><span
                                    class="stars-percent">0%</span></li>

                        </ul>
                    </div>
                    <span></span>
                </div>
                <div class="div-wide-horizontal-rule center"></div>
                <div class="two-col-grid">
                    <div class="three-col-grid reviewer-grid">
                        <img src="../assets/images/user.png">
                        <b>
                            <p>User Name</p>
                        </b>
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
                </form> --}}
        </section>


    </main>
@endsection
