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
<div class="contai">
    <div class="margin-top-4-em hide"></div>
    @include("includes.category-nav")
    
    <div class="products-stream">
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
