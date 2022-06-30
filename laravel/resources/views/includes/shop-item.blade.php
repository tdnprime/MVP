
@php

$id = $_GET["id"];
$product = DB::table("products")
->where("id", "=", $id)
->get();


@endphp

<div class='shop-item margin-bottom-4-em'>
 @include("includes.category-nav")
    <img src="../assets/images/products/{{$product[0]->img}}">
    <aside class="shop-item-details asides">
        <h2>{{$product[0]->name}}</h2>
        <p>{{$product[0]->description}}.</p>
        <p>{{$product[0]->price}}</p>
        <div class="stars-grid">
            <span class="material-icons">star</span>
            <span class="material-icons">star</span>
            <span class="material-icons">star</span>
            <span class="material-icons">star</span>
            <span class="material-icons">star_half</span>
            <a id='#jumptoreviews' href='' class='reviews-jump-to underline'># reviews</a>
        </div>
        <button class="button">ADD TO CART</button>
    </aside>


</div>
