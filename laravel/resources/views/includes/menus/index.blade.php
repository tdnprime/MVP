<div id="menu" class="menu ">
    <a class='fadein' id="menu-close" href="#/" title='Close'><span class="material-icons">close</span></a>
    <a class='fadein' href="/shop/groceries">Groceries</a>
    <a class='fadein' href="/shop/cosmetics">Cosmetics</a>
    <a class='fadein' href="/shop/bath">Bath</a>
    <a class='fadein' href="/shop/body">Body</a>
    <a class='fadein' href="/shop/health">Health</a>
    <a class='fadein' href="/shop/gifts">Gifts</a>
    <a class='fadein' href="/shop/men">Men</a>
    <a class='fadein' href="/shop/women">Women</a>
    <a class='fadein' href="/shop/boys">Boys</a>
    <a class='fadein' href="/shop/girls">Girls</a>
</div>
@auth

@else

    <div id='mobile-signin'>
        <a class='signin centered center' href='{{ url('auth/google') }}'>
            Sign in with Google
        </a>
    </div>
@endauth
