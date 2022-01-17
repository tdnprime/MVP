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
        
                <a class="" href="/direct/create">
                    <span class="material-icons">create</span>Creator Name</a>
            </section>
            <aside id="panel">
                <div class='centered'>
                @yield('content')
                </div>
            </aside>
            <section id='right-aside'></section>
        </main>

    </div>
    @include('includes.footer')
</body>
</html>
