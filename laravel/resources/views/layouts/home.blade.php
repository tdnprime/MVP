<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.meta')

</head>

<body id='home'>

    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menus.index')
        <div class="margin-auto">
            <div id='main-wrapper'>
            @yield('content')
            </div>
        </div>

    </div>
    @include('includes.footer')
</body>

</html>
