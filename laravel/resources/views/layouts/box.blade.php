<!DOCTYPE html>
<html lang="en" prefix="og: https://ogp.me/ns#">
<head>
    @include('includes.meta')
    
</head>

<body id='box' data-new-gr-c-s-check-loaded="8.892.0" data-gr-ext-installed="">
    <div id="progress">
        <div id="bar"></div>
    </div>

    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menus.index')

        @yield('content')

    </div>

    @include('includes.footer')
</body>
</html>
