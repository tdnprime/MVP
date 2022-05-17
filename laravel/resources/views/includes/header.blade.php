@include('includes.http-headers')

<span></span><!-- Hack !-->
<header>
    <span id="top-bar"></span>
    <div id="header-2nd-row">
    <div id='grid-1'>
      
        <a id='logo' href="/" title='Boxeon'>
            <img id='logo' src='{{ asset('../assets/images/logo.svg') }}' alt='logo' />
            </a>
        <a href="/shop/index">Shop</a>
        
            <a id='m-shop' class='one-em-font' href='/search/products' title='#'><span class='material-icons'>search</span></a>
        
        <span id="search-ico" class="material-icons"> </span>
        <form class='search hiden' action="/search/creator" method="get">
            {{ csrf_field() }}
            <input type="search" value='' placeholder="Find creator" name="creator">

        </form>
    </div>
    <div id='grid-2'>
<ul id='nav-header-right'>
    <li>
        <a id='cart' class='one-em-font' href='/cart/index' title='#'><span class='material-icons'>shopping_cart</span><span id="cart-text">cart</span></a>
    </li>
        @auth
            <li id='current-user'>
   <a id="showDropdown" class='fadein' href='#'>
                    <span><img id='header-user-icon' src='{{ $user->profile_photo_path }}' alt='You'></span>
            </a>

            <div class="dropdown">
                <div id="myDropdown" class="dropdown-content">
                  <a class="one-em-font" href="/home/index">Subscriptions</a>
                  <a class="one-em-font" href="/account/home">Account</a>
                  <a class="one-em-font" href="/signout">Sign Out</a>
                </div>
              </div>
        </li>
        @endauth


        @if (!Auth::check())
        <li>
            <a class='one-em-font' id='signin' href='{{ url('auth/google') }}'>
                Sign in
            </a>
        </li>
 
        @endif
</ul>
    </div>
   
</div>
</header>
