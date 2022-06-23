<div id="menu" class="menu ">

        <a class='fadein' href="{{route('home.index')}}"><span class="material-icons">home</span>Home</a>
        <a class='fadein' href="/box/create"><span class="material-icons">add_box</span>Create box</a>
        <a class='fadein' href="{{route('labels.home')}}"><span class="material-icons">local_shipping</span>Labels</a>
        <a class='fadein' href="{{route('partner.apply')}}"><span class="material-icons">group_work</span>Partner</a>
        <a class='fadein' href="/commission/index"><span class="material-icons">monetization_on</span>
            Commission</a>
            <a class='fadein' href="/invitations/home"><span class="material-icons">insert_invitation</span>
                Invitations</a>
        <a class='fadein' href="/account/home"><span class="material-icons">manage_accounts</span>Account</a>

        <a id="signout" class='fadein' href="/signout"><span class="material-icons">logout</span>Sign out</a>
            </div>
    
        <div id='mobile-signin'>
            <a class='signin centered center' href='{{ url('auth/google') }}'>
                Sign in with Google
            </a>
        </div>
    
    