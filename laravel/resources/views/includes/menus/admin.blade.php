<div id="menu" class="menu ">
    <a class='fadein' id="menu-close" href="#/" title='Close'><span class="material-icons">close</span></a>
    <a class='fadein' href="{{route('home.index')}}"><span class="material-icons">home</span>Home</a>
    <a class='fadein' href="{{route('admin.boxes')}}"><span class="material-icons">add_box</span>Boxes</a>
    <a class='fadein' href="{{route('admin.subscriptions')}}"><span class="material-icons">add_box</span>Subscriptions</a>
    <a class='fadein' href="{{route('admin.invitations')}}"><span class="material-icons">group_work</span>Invitations</a>
    <a class='fadein' href="{{route('admin.forms')}}"><span class="material-icons">monetization_on</span>
        Forms</a>
        <a class='fadein' href="{{route('admin.emails')}}"><span class="material-icons">insert_invitation</span>
            Emails</a>
    <a class='fadein' href="{{route('admin.entry')}}"><span class="material-icons">manage_accounts</span>Entry</a>
    <a id="signout" class='fadein' href="/signout"><span class="material-icons">logout</span>Sign out</a>
</div>
@auth

@else

    <div id='mobile-signin'>
        <a class='signin centered center' href='{{ url('admin/google') }}'>
            Sign in with Google
        </a>
    </div>
@endauth
