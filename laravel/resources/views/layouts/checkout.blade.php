<!DOCTYPE html>
<html lang="en" prefix="og: https://ogp.me/ns#">

<head>
    @section('title', 'Boxeon | Checkout')
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    @include('includes.meta')
    <link href="https://boxeon.com/assets/css/square.css" rel="stylesheet" />
    <script type="text/javascript" src="{{ asset('../assets/js/square.js') }}"></script>
    <script defer type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
</head>

<body id='index'>

    @yield('content')

</body>

</html>
