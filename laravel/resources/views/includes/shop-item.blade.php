
@php

$id = $_GET["id"];
$product = DB::table("products")
->where("id", "=", $id)
->get();


@endphp

<div class='shop-item margin-bottom-4-em'>
    <img src="../assets/images/{{$product[$i]->img}}">
    <aside class="shop-item-details asides">
        <h2>{{$product[$i]->name}}</h2>
        <p>{{$product[$i]->description}}.</p>
        <p>{{$product[$i]->price}}</p>
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
