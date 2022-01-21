
        <div  id="menu" class="menu ">
            <a  id="menu-close" href="#" title='Close'><span class="material-icons">close</span></a>
            <a    href="/home/index"><span class="material-icons">home</span>Home</a>
            <a    href="/box/create"><span class="material-icons">add_box</span>Create box</a>
            <a     href="/box/ship"><span class="material-icons">local_shipping</span>Shipping</a>
            <a     href="/partner"><span class="material-icons">group_work</span>Partner</a>
            <a     href="/blog/home"><span class="material-icons">feed</span>Blog</a>
            <a     href="/account/home"><span class="material-icons">manage_accounts</span>Account</a>
            <a id="signout" class="" href="/signout"><span class="material-icons">logout</span>Sign out</a>
        </div>
        @auth

        @else

        <div id='mobile-signin'>
            <a class='signin centered center' href='{{ url('auth/google') }}'>
                Sign in with Google
            </a>
        </div>
        @endauth
