<!DOCTYPE html>
<html lang="en" prefix="og: https://ogp.me/ns#">

<head>
    @section('title', 'Boxeon.com Checkout')
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    @include('includes.meta')
   <!-- <link href="../assets/css/square.css" rel="stylesheet" />!-->
   <script type="text/javascript" src="{{ asset('../assets/js/square.js') }}"></script>
    <script defer type="text/javascript" src="https://web.squarecdn.com/v1/square.js"></script>
</head>

<body id='checkout'>
    <div id="container">
    <div id="checkout-header-wrapper">
<div id="checkout-header" class="three-col-grid">

    <a href="/cart/index" title='Boxeon'>
        <img id='checkout-logo' src='{{ asset('../assets/images/logo.png') }}' alt='logo' />
        </a>
        <div><p class="white font-size-2-em">Checkout (<a class="one-em-font white" href="/cart/index"># items)</a></p></div>
        <a href="/privacy"><div class="material-icons">lock</div></a>
</div></div>
    @yield('content')
</div>
    @include('includes.footer')
</body>

</html>
