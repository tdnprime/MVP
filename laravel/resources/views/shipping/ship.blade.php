@extends('layouts.shipping')
@section('title', 'Boxeon | Labels')
@section('content')


    @if (isset($outgoing) && $outgoing > 0)
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
        $next_shipping = gmdate('F d', (int)$box[0]->created_at + $last_shipping);
        ?>
      

        <div class="centered margin-bottom-4-em">
            
            <img class="image-cta center" src="../assets/images/fly.svg" alt="Congratulations" />
            <h2>You're flying high, {{ $user->given_name }}!</h2>
            <p class="centered center">You have &nbsp;<span class="highlighted">{{ $outgoing }}</span>
                &nbsp;boxes to ship for month ending {{ $next_shipping }}. If your buyers paid for shipping,
                generate their shipping
                labels when you're ready to ship. Otherwise, buy labels or print their shipping addresses. </p>

        </div>

    @else

        <div class="centered margin-bottom-4-em">
            <img class="center image-cta" src="../assets/images/label.svg" >
            <h2>Your shipping labels</h2>
            <p class="centered center">You don't have any outgoing boxes to ship. </p>
            <br><br>
            <a class='button' href='/box/create'>Create box</a>
            <a class='button' href='/search/creator'>Find creator</a>
        </div>

    @endif

@endsection
