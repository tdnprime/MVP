<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.meta')
    <script src="{{ asset('vendor/kustomer/js/kustomer.js') }}" defer></script>
</head>

<body id='home'>
    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menu')

        @yield('content')
        
    </div>
    @include('includes.footer')
</body>
</html>
