@php

$products = DB::table('products')
    ->where('category', '=', 'Staple')
    ->get();
$count = count($products);

@endphp

<span></span>
<div class="container">
    <h2>{{ $heading ?? '' }}</h2>
    @if (isset($heading))
        <div class="div-horizontal-rule"></div>
    @endif
    <p>{{ $pitch ?? '' }}</p>
    <div class="products-stream">

        @for ($i = 0; $i < $count; $i++)
            <div>
                <a href="/shop/item?id={{ $products[$i]->id }}"><img src="../assets/images/{{ $products[$i]->img }}"
                        alt="{{ $products[$i]->name }}"></a>
                <!-- <p class="as-seen-on center centered">5% / 15%</p>!-->
                <a class="" href="/shop/item?id={{ $products[$i]->id }}">
                    <p>{{ $products[$i]->name }}</p>
                </a>
                @include('includes.stars')
                   
                <form>
                    <select class="margin-top-zero" name="quantity">
                        <option selected value="1">Qty: 1</option>
                        <option value="2">Qty: 2</option>
                        <option value="3">Qty: 3</option>
                        <option value="4">Qty: 4</option>
                        <option value="5">Qty: 5</option>
                        <option value="6">Qty: 6</option>
                        <option value="7">Qty: 7</option>
                    </select>&nbsp;&nbsp;
                    <select class="margin-top-zero" name="plan">
                        <option invalid>Choose price/plan</option>
                        <option value="{{ $products[$i]->price }}">${{ $products[$i]->price }} Every month</option>
                    </select>
                </form>
            
                <button id="cart-add" class="button">SUBSCRIBE NOW</button>
            </div>
        @endfor
    </div>


</div>
