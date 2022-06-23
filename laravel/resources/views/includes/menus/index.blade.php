<div id="menu" class="menu">
    <span id="cart-left-arrow" class="material-icons white">arrow_left</span>
<h2>Your cart</h2>


<div id="flyout">

</div>

<section class="fix-to-bottom">
    <div class="card-white-bg">
        <b>
            <h2 class="cart-subtotal text-red">Subtotal (# items) $cost</h2>
        </b>
        <form action="/checkout/index" method="post">
            @csrf
            <input type="submit" class="button yellowbtn" value="Proceed to checkout">
        </form>
    </div>
</div>
<div id="cart_overlay"></div>
@auth

@else

    <div id='mobile-signin'>
        <a class='signin centered center' href='{{ url('auth/google') }}'>
            Sign in with Google
        </a>
    </div>
@endauth
