<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Boxeon | Messages')
    @include('includes.meta')

</head>

<body id='home'>
    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menu')
        <main>
            <section id="left-aside">
                @if ($subs->count() > 0)
                    <h2>Messages</h2>
                    @foreach ($subs as $sub)
                        <a class="message-create" href="/messages/create" data-type-id="{{ $sub->id }}">
                            <div class='recipients-grid'>
                                <div><span><img id='header-user-icon' src='{{$sub->profile_photo_path}}'/></span>
                                    {{ $sub->given_name }}
                                    &nbsp;{{ $sub->family_name }} 
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif

            </section>
            @yield('content')
            <section id='right-aside'></section>
        </main>

    </div>
    @include('includes.footer')
</body>

</html>
