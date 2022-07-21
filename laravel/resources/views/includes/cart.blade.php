@if (isset($cart))
    <main id="cart-main" class="fadein">
        <section class="card cart-section center w100per padding-1-em">
            <div class="cart-header">
                <h2 class="font-size-2-em">Shopping cart</h2>
            </div>
            <section class="order-summary m-hide">
                <div class="card-white-bg">
    
                    <h2 class="hide">Subtotal (<span class="cart-count">&nbsp;</span> items) <span
                            class="cart-total text-red">&nbsp;</span></h2>
    
                    <form class="cartcheckout" action="/checkout/index" method="post">
                        @csrf
                        <input type="submit" class="button yellowbtn" value="Proceed to checkout">
                        <p class="float-right">Secure checkout powered by</p>
                        <img class="float-right" src="../assets/images/square-logo.png" alt="Square">
                    </form>
                </div>
            </section>
            @for ($i = 0; $i < count($cart); $i++)
                <div class="cart-items">
                    <img class="cart-image" src="../assets/images/products/{{ $cart[$i]->img }}"
                        alt="{{ $cart[$i]->name }}" />
                    <div>
                        <div>
                            <h2>{{ $cart[$i]->name }}</h2>
                            <p class="stock green">In stock</p>
                            <h2 id="itemprice{{ $cart[$i]->product }}" class='cart-item-price text-red'>
                            
                                ${{ (int)$cart[$i]->price * (int)$cart[$i]->quantity }}</h2>      
                        </div>
                        <div class="cart-item-updater">
                            <form class="form-plan" action="/cart" method="post">
                                <select data-product="{{ $cart[$i]->product }}" data-price={{ $cart[$i]->basePrice }}
                                    class="select-plan margin-top-zero" name="quantity">
                                    <option invalid>Select Quantity</option>
                                    @php
                                        $selected = $cart[$i]->quantity;
                                    @endphp
                                    @for ($e = 1; $e < 7; $e++)
                                        @if ($selected == $e)
                                            <option selected value="{{ $e }}">Qty: {{ $e }}
                                            </option>
                                        @else
                                            <option value="{{ $e }}">Qty: {{ $e }}</option>
                                        @endif
                                    @endfor
                                </select>
                                <select data-product="{{ $cart[$i]->product }}" data-price={{$cart[$i]->basePrice}} name="plan"
                                    class="select-plan margin-top-zero">
                                    <option invalid>Select Subscription</option>
                                    <option value="1" data-price="{{ $cart[$i]->price }}"
                                        @if ($cart[$i]->plan == 1) selected @endif>${{ $cart[$i]->basePrice }} -
                                        Every month</option>
                                    <option value="2" data-price="{{ $cart[$i]->basePrice + 1 }}"
                                        @if ($cart[$i]->plan == 2) selected @endif>${{ $cart[$i]->basePrice + 1 }}
                                        - Every 2 months</option>
                                    <option value="3" data-price="{{ $cart[$i]->basePrice + 2 }}"
                                        @if ($cart[$i]->plan == 3) selected @endif>${{ $cart[$i]->basePrice + 2 }}
                                        - Every 3 months</option>
                                    <option value="0" data-price="{{ $cart[$i]->basePrice + 3 }}"
                                        @if ($cart[$i]->plan == 0) selected @endif>${{ $cart[$i]->basePrice + 3 }}
                                        - One-time purchase</option>
                                </select>
                                <button data-quantity="1" data-name="{{ $cart[$i]->name }}" data-plan="1" data-img="{{ $cart[$i]->img }}" data-id="{{ $cart[$i]->product }}" data-basePrice="{{$cart[$i]->price }}" data-price="{{$cart[$i]->price }}" class="cart-add button display-none">SUBSCRIBE NOW</button>
                            </form>
                            <a href="#" title="Delete"><span data-product="{{ $cart[$i]->product }}" class="material-icons delete-icon w300">delete_forever</span></a>
                        </div>
                    </div>
                </div>
            @endfor
            <div id="m-checkout-summary">
                <div  class="card-white-bg w100per m-checkout-summary">
            <h2 class="cart-subtotal">Subtotal (<span class="cart-count">&nbsp;</span> items) <span
                    class="cart-total text-red">&nbsp;</span></h2>
            <form class="w300 float-right clear-both cartcheckout">
                @csrf
                <input type="submit" class="button yellowbtn" value="Proceed to checkout">
                <p class="float-right">Secure checkout powered by</p>
                <img class="float-right clear-both" src="../assets/images/square-logo.png" alt="Square">
            </form>
        </div>
        </div>
        </section>
        <section id="order-summary" class="hide">
            <div class="card-white-bg">

                <h2 class="hide cart-subtotal">Subtotal (<span class="cart-count">&nbsp;</span> items) <span
                        class="cart-total text-red">&nbsp;</span></h2>

                <form class="cartcheckout" action="/checkout/index" method="post">
                    @csrf
                    <input type="submit" class="button yellowbtn" value="Proceed to checkout">
                    <p class="float-right">Secure checkout powered by</p>
                    <img class="float-right" src="../assets/images/square-logo.png" alt="Square"><br>
                </form>
            </div>
        </section>
    </main>
@else
    <section class="section maxw1035">
        <div class="alert-info">
            <p><span class="material-icons">star</span>&nbsp;Your cart is empty.</p>
        </div>
    </section>

    @include('includes.shop-products')
@endif
