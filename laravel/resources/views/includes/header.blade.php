@include('includes.http-headers')

<span></span><!-- Hack !-->
<header>
    <a href="#" title="Menu" id='menu-icon'>
        <span class="material-icons">menu</span></a>
    <a id='logo' href="/home/index" title='Boxeon home'>
        <img id='logo' src='{{ asset('../assets/images/logo.svg') }}' alt='logo' />
        <span id="beta">Beta</span></a>

    @auth

    <div id='current-user' class='two-col-grid'>
        <a href='/messages/index' title='Messages'><span class='material-icons'>mail</span><span id='unread-count'>@include('messenger.unread-count')</span></a>
        <a  href='/box/{{ $user ? $user->id : '0' }}/edit' title='Edit mode'>
            <span class='material-icons'>account_box</span> {{ $user->given_name }}'s Boxeon
        </a>
    </div>

    @else
        <a id='signin' href='{{ url('auth/google') }}'>
            Sign in with Google
        </a>
    @endauth
</header>
