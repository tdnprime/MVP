<div id="menu" class="menu ">
    <a class='fadein' id="menu-close" href="#/" title='Close'><span class="material-icons">close</span></a>
    <a class='fadein' href="{{route('home.index')}}"><span class="material-icons">home</span>Home</a>
    <a class='fadein' href="{{route('partner.apply')}}"><span class="material-icons">group_work</span>Apply</a>

    <a class='fadein' href="/box/create"><span class="material-icons">add_box</span>Create box</a>
   <a id="signout" class='fadein' href='/signout'><span class="material-icons">logout</span>Sign out</a>
</div>
@auth

@else

    <div id='mobile-signin'>
        <a class='signin centered center' href='{{ url('auth/google') }}'>
            Sign in with Google
        </a>
    </div>
@endauth
