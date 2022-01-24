@extends('layouts.home')
@section('title', 'Boxeon | Shipping')
@section('content')
    <main class="fadein">
        <section id="left-aside">
            <h2>Shipping</h2>
            <a class="message-create" href="/box/labels" data-type-id="">
                <div class='recipients-grid'>
                    <div class='position-relative'><span class="material-icons">people_alt</span>
                        Generate labels
                    </div>
                    <div>
                    </div>
                </div>
            </a>
            <a class="message-create" href="/box/labels/purchase" data-type-id="">
                <div class='recipients-grid'>
                    <div class='position-relative'><span class="material-icons">inventory_2</span>
                        Purchase labels
                    </div>
                    <div>
                    </div>
                </div>
            </a>
            <a class="message-create" href="box/addresses">
                <div class='recipients-grid'>
                    <div class='position-relative'><span class="material-icons">inventory_2</span>
                        Print addresses
                    </div>
                    <div>
                    </div>
                </div>
            </a>
        </section>
        <aside id="panel">
            <div class="lift">

                @if ($outgoing > 0)
                    <?php
                    $box = DB::table('boxes')
                        ->where('user_id', '=', [$user->id])
                        ->select('created_at', 'shipping_count')
                        ->get();
                    
                    if (!is_null($box[0]->shipping_count)) {
                        $last_shipping = 2629743 * $box[0]->shipping_count;
                    } else {
                        $last_shipping = 2629743;
                    }
                    $next_shipping = gmdate('F d', $box[0]->created_at + $last_shipping);
                    ?>

                    <div class="centered margin-bottom-4-em">
                        <img class="image-cta" src="../assets/images/fly.svg" alt="Congratulations" />
                        <h2>You're flying high, {{ $user->given_name }}!</h2>
                        <p class="centered center">You have &nbsp;<span class="highlighted">{{ $outgoing }}</span>
                            &nbsp;boxes to ship for month ending {{ $next_shipping }}. If your buyers paid for shipping,
                            generate their shipping
                            labels when you're ready to ship. Otherwise, buy labels or print their shipping addresses. </p>

                    </div>
                @else
                    <div class="centered margin-bottom-4-em">
                        <img class="image-cta" src="../assets/images/order-delivered.svg" alt="Congratulations" />
                        <h2>Shipping Center</h2>
                        <p class="centered center">You don't have any outgoing boxes to ship. </p>

                        <div id="smart-button-container">
                     
                            <div id="paypal-button-container"></div>

                        </div>

                    </div>
                @endif

            </div>
        </aside>
        <section id="right-aside"></section>
    </main>

@endsection
