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
<section class='section card maxw1036'>
    @include('includes.category-nav')
    <div class="products-stream">
        @for ($i = 0; $i < count($product); $i++)
            <div class="fit-content margin-auto">
                <a href="/shop/item?id={{ $product[$i]->id }}"><img src="../assets/images/products/{{ $product[$i]->img }}"
                        alt="{{ $product[$i]->name }}"></a>
                <a class="" href="/shop/item?id={{ $product[$i]->id }}">
                    <p>{{ $product[$i]->name }}</p>
                </a>
                <p>Weight: {{$product[$i]->weight}} pound(s)</p>
                @include('includes.stars')
                @include('includes.plan-form')

            </div>
        @endfor
      
    </div>
</section>
@include('includes.preorder-form')