@php

if (isset($_GET['c'])) {
    $query = ucfirst($_GET['c']);

    $product = DB::table('products')
        ->where('category', '=', $query)
        ->get();
} else {
    $product = DB::table('products')
        ->where('category', '=', 'Staple')
        ->get();

        $sellers = DB::table('products')
        ->where('category', '=', 'Produce')
        ->get();
}

@endphp

<span></span>
<div class="container margin-top-4-em">

    <div id="nav-categories">
        <a href="/shop/index?c=staple" class="button clearbtn">Staples</a>
        <a href="/shop/index?c=spice" class="button clearbtn">Herbs & Spices</a>
        <a href="/shop/index?c=produce" class="button clearbtn">Fruits & Produce</a>
        <a href="/shop/index?c=body" class="button clearbtn">Bath & Body</a>
        <a href="/shop/index?c=snack" class="button clearbtn">Snacks</a>
    </div>
    <div class="products-stream margin-top-4-em">
        @for ($i = 0; $i < count($product); $i++)
            <div>
                <a href="/shop/item?id={{ $product[$i]->id }}"><img src="../assets/images/{{ $product[$i]->img }}"
                        alt="{{ $product[$i]->name }}"></a>
                <a class="" href="/shop/item?id={{ $product[$i]->id }}">
                    <p>{{ $product[$i]->name }}</p>
                </a>
                @include('includes.stars')

                @include('includes.plan-form')

            </div>
        @endfor
    </div>


</div>
