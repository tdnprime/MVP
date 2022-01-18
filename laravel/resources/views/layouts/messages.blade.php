<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Inbox')
    @include('includes.meta')

</head>

<body id='home'>
    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menu')
        <main>
            <section id="left-aside">
                <h2>Messages</h2>

                @if ($subs->count() > 0)
                    @foreach ($subs as $sub)
                    <a id="message-create" href="/messages/create" data-type-id="{{ $sub->id }}"> 
                        <div class='recipients-grid'>
                        <div><span class="material-icons">account_box</span>
                            {{ $sub->given_name }}
                            &nbsp;{{ $sub->family_name }} <span class="new-message-alert"></span>
                        </div><div>

                            <p class="message-preview">Preview</p>
                        </div>
                        </div></a>
                    @endforeach
                @endif

            </section>
            @yield('content')
            <section id='right-aside'></section>
        </main>

    </div>
    @include('includes.footer')
       <!-- Include all compiled plugins (below), or include individual files as needed 
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
       integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
   </script>-->
</body>

</html>
