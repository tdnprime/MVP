@include('includes.http-headers')

<span></span><!-- Hack !-->
<header>
    <div id='grid-1'>
      
        <a id='logo' href="/home/index" title='Boxeon home'>
            <img id='logo' src='{{ asset('../assets/images/logo.svg') }}' alt='logo' />
            <span id="beta">Beta</span></a>
        <b><a id='menu-icon' class='underline' href="#">Shop</a></b>
        <span id="search-ico" class="material-icons"> </span>
        <form class='search hiden' action="/search/creator" method="get">
            {{ csrf_field() }}
            <input type="search" value='' placeholder="Find creator" name="creator">

        </form>
    </div>
    <div id='grid-2'>
<ul id='nav-header-right'>
    <li>
        <a id='cart' class='one-em-font' href='/cart/' title='#'><span class='material-icons'>shopping_cart</span>cart<span></span></a>
    </li>
        @auth
            <li id='current-user'>
   <a id="signout" class='fadein' href='/signout'
                    <span><img id='header-user-icon' src='{{ $user->profile_photo_path }}' alt='You'></span>
            </a>
        </li>
        @endauth


        @if (!Auth::check())
        <li>
            <a class='one-em-font' id='signin' href='{{ url('auth/google') }}'>
                Sign in with Google
            </a>
        </li>
        @endif
</ul>
    </div>
   

</header>
