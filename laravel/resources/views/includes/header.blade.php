@include('includes.http-headers')

<span></span><!-- Hack !-->
<header>
    <div id='grid-1'>
    <a href="#" title="Menu" id='menu-icon'>
        <span class="material-icons">menu</span></a>
    <a id='logo' href="/home/index" title='Boxeon home'>
        <img id='logo' src='{{ asset('../assets/images/logo.svg') }}' alt='logo' />
        <span id="beta">Beta</span></a>
        <a href="/school/home"><span class="material-icons icon-in-header">school</span>&nbsp;Learn</a>
        <span id="search-ico" class="material-icons"> </span>
            <form class='search hiden' action="/search/creator" method="get">
                {{ csrf_field() }}
                <input type="search" value='' placeholder="Find creator" name="creator">
               
            </form>
        </div>
        <div id='grid-2'>
            @auth
            <div id='current-user'>
          {{--  <a href='/messages/inbox' title='Messages'><span class='material-icons'>mail</span><span
                    id='unread-count'>@include('messenger.unread-count')</span></a>--}}
            <a href='/box/{{ $user ? $user->id : '0' }}/edit' title='Edit mode'>
                <span><img id='header-user-icon' src='{{$user->profile_photo_path}}' alt='You'></span>
            </a>
            </div>
            @endauth
        

        @if (!Auth::check())
        <a id='signin' href='{{ url('auth/google') }}'>
            Sign in with Google
        </a>
        @endif
        </div>
    
</header>
