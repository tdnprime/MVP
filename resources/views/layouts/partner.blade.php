<!DOCTYPE html>
<html>
<head>
    @include('includes.meta')
</head>
<body id='partner'>
    <div id="progress">
      <div id="bar"></div>
    </div>
    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menu')

        @yield('content')

    </div>
    @include('includes.footer')
</body>
</html>
