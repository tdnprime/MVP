@extends('layouts.index')
@section('title', 'Boxeon.com Monthly African Groceries Delivery')
@section('content')
    <div id="masthead">
        <aside class="centered asides call-out mobile-scroll"><br>
            <h2 id="headline_h1" class="font-size-3-em">African Groceries Delivered To You Monthly</h2>
            <p class="centered center font-1-5-em">Home in a box. Subscribe to monthly deliveries of your favorite foods from
                home
                to save time and money. Cancel anytime.</p><br>
            <a href="/shop/index?c=staple" class="button uppercase">SUBSCRIBE NOW</a>
        </aside>
        <br><br>
    </div>
    <main> <a id='whatis' href='#whatis'></a>
        @include('includes.works')
        <section class="block maxw1035 section">
          
                
                <div class="learn-more-index-wrapper">
                    <img class="float-left h50px border-radius margin-right-1-em border-yellow"
                        src="../assets/images/tabitha-girl.jpg" alt="Boxeon" />
                    <a class="learn-more" href="/school/subscriptions">
                        <h2>Learn more about Boxeon subscriptions<span class="material-icons">arrow_forward</span></h2>
                    </a>
                
              
            </div>
        </section>
        @include('includes.shop-products')
        
        <section id="creators-bar" class="max-width-1035 section  mobile-scroll display-none">
            <div class="center div-horizontal-rule"></div>
            <h2 class="centered primary-color">BEST SELLERS</h2>
            <div id="as-seen-on" class="four-col-grid">
                @php
                    $sellers = DB::table('products')
                        ->where('category', '=', 'Snack')
                        ->take(4)
                        ->get();
                    
                @endphp
                @for ($i = 0; $i < count($sellers); $i++)
                    <div>
                        <a href="/shop/item?id={{ $sellers[$i]->id }}">
                            <img class="maxw200px" src="../assets/images/products/{{ $sellers[$i]->img }}"></a>
                        <a class="" href="/shop/item?id={{ $sellers[$i]->id }}">
                            <p>{{ $sellers[$i]->name }}</p>
                        </a>
                    </div>
                @endfor
            </div>
        </section>
    </main>
@endsection
