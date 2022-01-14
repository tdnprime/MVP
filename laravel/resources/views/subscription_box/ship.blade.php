@extends('layouts.home')

@section('content')

    <main class="fadein">
        <section id="left-aside"></section>
        <aside id="panel">
            @include('includes.ship-nav')

            <div class="lift">
         
                @if ($outgoing > 0)
                <?php
                $box = DB::table("boxes")
                ->where('user_id', '=', [$user->id])
                ->select('created_at', 'shipping_count')
                ->get();

                if(!is_null($box[0]->shipping_count)){

                  $last_shipping = 2629743 * $box[0]->shipping_count;

                }else{

                $last_shipping = 2629743;

                }
                $next_shipping = gmdate("F d", $box[0]->created_at + $last_shipping)
                ?>
               
                    <div class="centered margin-bottom-4-em">
                        <img class="image-ego-boost" src="../assets/images/fly.svg" alt="Congratulations" />
                        <h2>You're flying high, {{ $user->given_name }}!</h2>
                        <p class="centered center">You have &nbsp;<span class="highlighted">{{$outgoing}}</span> &nbsp;boxes to ship for month ending {{$next_shipping}}. If your buyers paid for shipping, generate their shipping
                            labels when you're ready to ship. Otherwise, print their shipping addresses. </p>
                        <div class="margin-top-4-em">
                        <a class="button" href="/box/labels">Generate labels</a>
                        <a class="button" href="#" id="buy-labels">Buy labels</a>
                        <a class="button" href="/box/addresses" id="print-addresses">Print addresses</a>
                        </div>
                    </div>
                @else
                    <div class="alert">
                        <p class="material-icons">info</p>
                        <p>Sorry {{ $user->given_name }}, you don't have any outgoing boxes.</p>
                    </div>
                @endif

            </div>
        </aside>
        <section id="right-aside"></section>
    </main>

@endsection
