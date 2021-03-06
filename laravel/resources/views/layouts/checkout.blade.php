<!DOCTYPE html>
<html lang="en" prefix="og: https://ogp.me/ns#">

<head>
    @section('title', 'Boxeon.com Checkout')
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    @include('includes.meta')
     <link href="../assets/css/square.css" rel="stylesheet" />
     <script type="text/javascript" src="{{ asset('../assets/js/square.js') }}"></script>

    <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
</head>

<body id='index' class="checkout">
    <div id="container">
        <div id="checkout-header-wrapper">
            <div id="checkout-header" class="three-col-grid">

                <a href="/cart/index" title='Boxeon'>
                    <img id='checkout-logo' src='{{ asset('../assets/images/logo.png') }}' alt='logo' />
                </a>
                <div>
                    <p class="white hide font-size-2-em">Checkout (<a class="one-em-font white underline" href="/cart/index">{{count($cart)}}&nbsp;items</a>)</p>
                </div>
                <a href="/privacy" class="m-padding-right-zero">
                    <div class="material-icons">lock</div>
                </a>
            </div>
        </div>
        @yield('content')
    </div>
    @include('includes.footer')
</body>

</html>
