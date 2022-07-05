<!DOCTYPE html>
<html lang="en" prefix="og: https://ogp.me/ns#">
<head>
    @include('includes.meta')
</head>
<body id='index'>
    <div id="container">
        <span id="loader" class="loader"></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menus.index')
        @yield('content')
    </div>
    @include('includes.footer')
</body>
</html>
