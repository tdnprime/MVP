@if (isset($cart))
    <main id="cart-main" class="fadein">
        <section class="cart-section center w100per padding-1-em">

            <div class="cart-header">
                <h2 class="font-size-2-em">Shopping cart</h2>
            </div>

            <section class="display-none">
                <div class="card-white-bg padding-zero">
                    <b>
                        <h2 class="cart-subtotal black-font">Subtotal (<span class="cart-count"></span>&nbsp;items)
                            <span class="cart-total text-red">&nbsp;</span></h2>
                    </b>
                    <button class="button yellowbtn">Proceed to checkout</button>
                </div>

            </section>
            @for ($i = 0; $i < count($cart); $i++)
                <div class="cart-items">

                    <img class="w300px" src="../assets/images/products/{{ $cart[$i]->img }}"
                        alt="{{ $cart[$i]->name }}" />

                    <div>
                        <div>
                            <h2>{{ $cart[$i]->name }}</h2>
                            <p class="stock green">In stock</p>
                            <h2 id="itemprice{{ $cart[$i]->product }}" class='cart-item-price text-red'>
                                @if($cart[$i]->plan == 1)
                                ${{ $cart[$i]->price * $cart[$i]->quantity }}</h2>
                                @elseif($cart[$i]->plan == 2)
                                ${{ $cart[$i]->price + 1 * $cart[$i]->quantity }}</h2>
                                @elseif($cart[$i]->plan == 3)
                                ${{ $cart[$i]->price + 2 * $cart[$i]->quantity }}</h2>
                                @elseif($cart[$i]->plan == 0)
                                ${{ $cart[$i]->price + 2 * $cart[$i]->quantity }}</h2>
                                @endif 
                        </div>
                        <div class="cart-item-updater">
                            <form class="form-plan" action="/cart" method="post">
                                <select data-product="{{ $cart[$i]->product }}" data-price={{ $cart[$i]->price }}
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
                                <select data-product="{{ $cart[$i]->product }}" data-price={{$cart[$i]->price}} name="plan"
                                    class="select-plan margin-top-zero">
                                    <option invalid>Select Subscription</option>
                                    <option value="1" data-price="{{ $cart[$i]->price }}"
                                        @if ($cart[$i]->plan == 1) selected @endif>${{ $cart[$i]->price }} -
                                        Every month</option>
                                    <option value="2" data-price="{{ $cart[$i]->price + 1 }}"
                                        @if ($cart[$i]->plan == 2) selected @endif>${{ $cart[$i]->price + 1 }}
                                        - Every 2 months</option>
                                    <option value="3" data-price="{{ $cart[$i]->price + 2 }}"
                                        @if ($cart[$i]->plan == 3) selected @endif>${{ $cart[$i]->price + 2 }}
                                        - Every 3 months</option>
                                    <option value="0" data-price="{{ $cart[$i]->price + 3 }}"
                                        @if ($cart[$i]->plan == 0) selected @endif>${{ $cart[$i]->price + 3 }}
                                        - One-time purchase</option>
                                </select>
                            </form>
                            <a href="#" title="Delete"><span data-product="{{ $cart[$i]->product }}" class="material-icons delete-icon">delete_forever</span></a>
                        </div>
                    </div>
                </div>
            @endfor

            <h2 class="cart-subtotal">Subtotal (<span class="cart-count">&nbsp;</span> items) <span
                    class="cart-total text-red">&nbsp;</span></h2>
            <form class="hide" action="/checkout/index" method="post">
                @csrf
                <input type="submit" class="button yellowbtn" value="Proceed to checkout">
            </form>

        </section>

        <section>
            <div class="card-white-bg">

                <h2 class="hide">Subtotal (<span class="cart-count">&nbsp;</span> items) <span
                        class="cart-total text-red">&nbsp;</span></h2>

                <form action="/checkout/index" method="post">
                    @csrf
                    <input type="submit" class="button yellowbtn" value="Proceed to checkout">
                </form>
            </div>
        </section>
    </main>
@else
    <section class="section margin-top-4-em maxw1035">
        <div class="alert-info w100per">
            <p><span class="material-icons">info</span>&nbsp;Your cart is empty.</p>
        </div>
    </section>

    @include('includes.shop-products')
@endif
