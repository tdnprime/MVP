@include('includes.http-headers')

<span></span><!-- Hack !-->
<header>
    <a href="#" title="Menu" id='menu-icon'>
        <span class="material-icons">menu</span></a>
    <a id='logo' href="/home/index" title='Boxeon home'>
        <img id='logo' src='{{ asset('../assets/images/logo.svg') }}' alt='logo' />
        <span id="beta">Beta</span></a>
    <a href="/commission/index" title="Earn big!"><span class="material-icons">monetization_on</span> Commission</a>

        <div id='current-user' class='two-col-grid'>
            <form class='search' action="/search/creator" method="get">
                {{ csrf_field() }}
                <input type="search" value='' placeholder="Find a creator you love" name="creator">
                <span id="search-icon" class="material-icons">
                    search
                </span>
            </form>
            <span></span><!-- Hack !-->
            @auth
            <a href='/messages/index' title='Messages'><span class='material-icons'>mail</span><span
                    id='unread-count'>@include('messenger.unread-count')</span></a>
            <a href='/box/{{ $user ? $user->id : '0' }}/edit' title='Edit mode'>
                <span><img id='header-user-icon' src='{{$user->profile_photo_path}}' alt='You'></span> {{ $user->given_name }}'s Boxeon
            </a>
            @endauth
        </div>

        @if (!Auth::check())
        <a id='signin' href='{{ url('auth/google') }}'>
            Sign in with Google
        </a>
        @endif
    
</header>
