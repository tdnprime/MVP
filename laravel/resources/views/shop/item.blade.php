@extends('layouts.home')
<title>Boxeon.com <?php echo 'Shop ' . $product[0]->name; ?> | Best African Market Online</title>
@section('content')
    @if (session()->has('message'))
        <dialog class="alert">
            <p class='centered'> {{ session()->get('message') }}</p>
        </dialog>
    @endif
    <main>
        <section class="card maxw1035 section">
            @include('includes.category-nav')
            <div id="product-stream" class="fit-content margin-auto two-col-grid">
                <img class="image-lg-product margin-auto" src="../assets/images/products/{{ $product[0]->img }}"
                    alt='{{ $product[0]->name }}' />
                <div class="maxw250px">
                    <p class="red-tag">SUBSCRIBE & SAVE</p>
                    <a href="/shop/item?id={{ $product[0]->id }}">
                        <p>{{ $product[0]->name }}</p>
                    </a>

                    @include('includes.stars')

                    <p class="green">In Stock</p>
                    <p class="w300">{{ $product[0]->description }}</p>
                    <h4 class="uppercase">Product details</h4>
                    <p>Weight: {{$product[0]->weight}} {{$product[0]->unit}}</p>
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
                    <button data-quantity="1" data-name="{{ $product[0]->name }}" data-plan="1" data-img="{{ $product[0]->img }}" data-id="{{ $product[0]->id }}" data-basePrice="{{$product[0]->price }}" data-price="{{$product[0]->price }}" class="cart-add button">SUBSCRIBE NOW</button>
                    <div class="two-col-grid charitable-grid">
                        <img class="w40px" src="../assets/images/girl.jpg" alt="Orphan Girl" />
                        <a href="/school/subscriptions" class="primary-color">
                            Learn about Boxeon subscriptions
                        </a>
                    </div>
                </div>
            </div>
            <h2 class='center margin-top-4-em'>Customer Reviews</h2>
            <br>
            @if (count($reviews) > 0)
                @for ($i = 0; $i < count($reviews); $i++)
                    <div class="review two-col-grid">
                        <div class="three-col-grid reviewer-grid">
                         <span class="material-icons margin-block-start-end">account_circle</span>
                            
                                <p class="bold">{{ $reviews[$i]->name }}</p>
                            
                            <div class="stars-grid">
                                @php
                                    if (isset($reviews[$i])) {
                                        if ($reviews[$i]->stars == 5) {
                                            $stars = 5;
                                            $diff = 0;
                                        }
                                        if ($reviews[$i]->stars < 5) {
                                            $stars = (int) $reviews[$i]->stars;
                                            $diff = 5 - $stars;
                                        }
                                    } else {
                                        $stars = 0;
                                        $diff = 5;
                                    }

                                @endphp

                                @for ($s = 0; $s < $stars; $s++)
                                    <span class="material-icons text-black">star</span>
                                @endfor

                                @for ($d = 0; $d < $diff; $d++)
                                    <span class="material-icons text-grey">star</span>
                                @endfor

                            </div>
                        </div>
                        <div>
                            <p>@php echo nl2br($reviews[$i]->review); @endphp</p>
                        </div>
                    </div>
                @endfor
            @else
                <div class="alert-info">
                    <p><span class="material-icons">star</span>&nbsp;Be the first to leave a review!</p>
                </div>
            @endif
            <button id="show-review-form" class="button center margin-top-4-em">WRITE A REVIEW</button>
            <form class="w100per" id="form-reviews" action='/reviews/submit' method='post'>
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-75">
                        <input type="hidden" value="{{ $product[0]->id }}" name="product">
                        <input type="text" required placeholder="Name" name="name">
                    </div>
                    <div class="col-75">
                        <select name="stars" required>
                            <option disabled>Select stars</option>
                            <option value="5">5 stars</option>
                            <option value="4">4 stars</option>
                            <option value="3">3 stars</option>
                            <option value="2">2 stars</option>
                            <option value="1">1 star</option>
                        </select>
                    </div>
                    <div class="col-75">
                        <textarea required rows="10" cols="40" name="review" placeholder="Write a review"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type='submit' value='SUBMIT'>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
