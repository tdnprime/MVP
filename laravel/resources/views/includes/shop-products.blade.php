@php

if (isset($_GET['c'])) {
    $query = ucfirst($_GET['c']);

    $product = DB::table('products')
        ->where('category', '=', $query)
        ->get();
} else {
    $product = DB::table('products')
        ->where('products.category', '=', 'Staple')
        ->limit(9)
        ->get();
}

@endphp

<span></span>
<section class='section card maxw1036'>
    @include('includes.category-nav')
    <div class="products-stream">
        @for ($i = 0; $i < count($product); $i++)

            @php
                // HACK
                $name = explode('.', $product[$i]->img);
                $img = $name[0] . '.jpeg';
                
            @endphp


            <div class="fit-content margin-auto">
                <a href="/shop/item?id={{ $product[$i]->id }}"><img
                        src="../assets/images/products/medium/{{ $img }}"
                        alt="{{ $product[$i]->name }}"></a>
                <a class="" href="/shop/item?id={{ $product[$i]->id }}">
                    <p class="product-title">{{ $product[$i]->name }}</p>
                </a>
                <p>Weight: {{$product[$i]->weight}} {{$product[$i]->unit}}</p>

                @php
                    
                    $r = DB::table('reviews')
                        ->where('product', '=', $product[$i]->id)
                        ->avg('stars');
                    $avg_reviews = (int) round($r);
                    
                    $total_reviews = DB::table('reviews')
                        ->where('product', '=', $product[$i]->id)
                        ->count();
                @endphp

                @include('includes.stars')
                @include('includes.plan-form')

            </div>
        @endfor

    </div>
</section>
@include('includes.preorder-form')
