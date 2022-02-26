<!DOCTYPE html>
<html>

<head>
    @include('includes.meta')
</head>

<body id='home'>
    <div id="progress">
        <div id="bar"></div>
    </div>
    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menus.app')

        <main>
            <section id='left-aside' class='hide'></section>
            <aside id='panel'>

                @yield('content')

            </aside>
            <section id='right-aside'>
            </section>
        </main>
    </div>
    @include('includes.footer')

    </div>
</body>

</html>
