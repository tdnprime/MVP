@include('includes.http-headers')

<span></span><!-- Hack !-->
<header>
    <a href="#" title="Menu" id='menu-icon'>
        <span class="material-icons">menu</span></a>
    <a id='logo' href="/home/index" title='Boxeon home'>
        <img id='logo' src='{{ asset('../assets/images/logo.svg') }}' alt='logo' />
        <span id="beta">Beta</span></a>

    @auth

        <a id='current-user' href='/box/{{ $user ? $user->id : '0' }}/edit' title='Edit mode'>
            <span class='material-icons'>account_box</span> {{ $user->given_name }}'s Boxeon
        </a>

    @else
        <a id='signin' href='{{ url('auth/google') }}'>
            Sign in with Google
        </a>
    @endauth
</header>
