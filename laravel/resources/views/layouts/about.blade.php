<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.meta')
</head>

<body id='about'>
    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menu.index')
        @yield('content')

    </div>
    @include('includes.footer')
</body>
</html>
