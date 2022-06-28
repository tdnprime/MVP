@include('includes.http-headers')
<span></span><!-- Hack !-->
<header>
    <span id="top-bar"></span>
    <div id="header-inner-wrapper">

        <a id='logo' href="/" title='Boxeon'>
            <img id='logo' src='{{ asset('../assets/images/logo.png') }}' alt='logo' />
        </a>

        <a class="button text-yellow hide" href="/shop/index" title="Shop">Shop</a>
        <a class="button text-yellow hide" href="/returns" title="Returns & Refunds">Returns & Refunds</a>
        <span class="hide"></span>
        <a id='m-shop' class='button one-em-font' href='/search/products' title='#'>
            <span class='material-icons'>search</span></a>


        @auth

            <a href="tel:+1646-450-4671‬" class="button one-em-font hide">646-450-4671‬</a>
            <a href="/cart/index" class="white button"><span><img id="cart" class="w30px" src="../assets/images/cart.png"
                        alt="Cart" /></span></a>

            <div>
                <a id="showDropdown" class='fadein button' href='#'>
                    <img id='header-user-icon' src='{{ $user->profile_photo_path }}' alt='You'>
                </a>
                <div class="dropdown">
                    <div id="myDropdown" class="dropdown-content">
                        <a class="one-em-font" href="/home/index">Subscriptions</a>
                        <a class="one-em-font" href="/account/home">Account</a>
                        <a class="one-em-font" href="/signout">Sign Out</a>
                    </div>
                </div>
            </div>
        @endauth
        @if (!Auth::check())
            <a href="tel:+1646-450-4671‬" class="button hide">646-450-4671‬</a>

            <a href="/cart/index" class="white button"><span><img class="w30px"
                        src="../assets/images/cart.png" alt="Cart" /></span></a>

            <a class='button' id='signin' href='{{ url('auth/google') }}'>
                Sign In With Google
            </a>
        @endif


    </div>


</header>
<section id="sub-nav" class="bg-color-yellow padding-2-per">

    <form id="mailing-list-form" action="/shop/search" method="post">
        @csrf
        <div class="row">
            <div class="col-75 two-col-grid">
                <input required type="text" placeholder="Search Boxeon" name="term">
                <input type='submit' value="SEARCH">
            </div>
        </div>

    </form>
<div class="four-col-grid">
    <span></span>
    <a href="/returns" title="Returns & Refunds">Returns & Refunds</a>
    <a href="tel:+1646-450-4671‬">646-450-4671‬</a>
    <span></span>
</div>
</section>