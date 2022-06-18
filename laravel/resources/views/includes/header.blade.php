@include('includes.http-headers')

<span></span><!-- Hack !-->
<header>
    <span id="top-bar"></span>
    <div id="header-inner-wrapper">
    <div>
      
        <a id='logo' href="/" title='Boxeon'>
            <img id='logo' src='{{ asset('../assets/images/logo.png') }}' alt='logo' />
            </a>
            <a id="anchor-shop" href="/shop/index" class="text-yellow" title="Shop">Shop</a>
        
            <a id='m-shop' class='one-em-font' href='/search/products' title='#'><span class='material-icons'>search</span></a>
        
<ul id='nav-header-right' class='display-inline'>
        @auth
       <li> <a id="cart" href="/cart/index" class="material-icons white">shopping_cart</a></li>
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
        <li class="hide">

            <a class='button margin-auto' id='signin' href='{{url('auth/google') }}'>
                Sign In With Google
            </a>
        </li>
 
        @endif
</ul>
    </div>
   
</div>
</header>
