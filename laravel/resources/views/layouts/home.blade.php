<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.meta')

</head>

<body id='home'>
   
    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menus.app')

        @yield('content')
        
    </div>
    @include('includes.footer')
</body>
</html>
