<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.meta')
    @php
    if(isset($_COOKIE["hash"])){

        $hash = $_COOKIE["hash"];
    }
    @endphp

    
  

</head>

<body id='index'>

    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menus.index')
        @yield('content')
        @include('includes.footer')
  
</body>

</html>
