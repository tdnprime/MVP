
{{-- WARNING #3 Of 3
    
    MAKE URL ABSOLUTE FOR PRODUCTION--}}

<header>
    <a href="#" title="Menu" id='menu-icon'>
        <span class="material-icons">menu</span></a>
        <a id='logo' href="/home" title='Boxeon home'>
<<<<<<< Updated upstream
            <img id='logo' src='{{ asset('../assets/images/logo.svg') }}' alt='logo'/>
=======
            <img id='logo' src='http://localhost:8000/assets/images/logo.svg' alt='logo'/>
>>>>>>> Stashed changes
            <span id="beta">Beta</span></a>

    @auth

    <a id='current-user' href='/box/{{ $user ? $user->id : '0'}}/edit' title='Edit mode'>
        <span class='material-icons'>account_box</span> {{$user->givenname}}'s Boxeon
    </a>

    @else
    <a id='signin' href='{{ url('auth/google') }}'>
        Sign in with Google
    </a>
    @endauth
</header>
