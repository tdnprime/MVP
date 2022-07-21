<div id="menu" class="menu">
    <span id="cart-left-arrow" class="material-icons white">arrow_left</span>
<h2>Your cart</h2>
<div id="flyout">
</div>
<section class="fix-to-botto">
    <div class="card-white-bg">
        <b>
            <h2>Subtotal (<span class="cart-count">&nbsp;</span> items) <span class="cart-total text-red">&nbsp;</span></h2>
        </b>
        <form class="maxw65per cartcheckout" action="/checkout/index" method="post">
            @csrf
            <input type="submit" class="button" value="Proceed to checkout">
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
