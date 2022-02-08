<title>@yield('title', config('app.name'))</title>
<meta property="og:title" content="Best place for content creators to earn, monthly, sustainable income" />
<meta property="og:description" content="Be a free spirit, start a subscription box, raise capital, it's easy." />
<meta property="og:type" content="website" />
<meta property="og:url" content="https://boxeon.com" />
<meta property="og:image" content="{{ asset('../assets/images/high-five.svg') }}" />
<meta name="description"
    content="Start and grow a subscription box business and secure monthly income. It's the wave of the future." />
<meta name="keywords"
    content="Boxeon, Patreon alternative, monitize content, Subscription box platform, make more money on Youtube">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="icon" type="image/svg+xml" href="{{ asset('../assets/images/favicon.svg') }}">
<link rel="alternate icon" href="{{ asset('../assets/images/favicon.svg') }}">
<link rel="mask-icon" href="https://boxeon.com/images/favicon.svg" color="#fff">
<link rel="stylesheet" href="{{ asset('../assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('../css/app.css') }}">
<link rel="stylesheet" media="screen and (min-width: 200px) and (max-width: 1810px)"
    href="{{ asset('../assets/css/mobile.css?v=3.6') }}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Concert%20One">
<script defer src="{{ asset('../assets/js/global.js?v=2.1') }}"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-10788250660"></script>

@php

$nonce = base64_encode('Content-Security-Policy: def');
$nonce2 = base64_encode('Contentaecurity-Polyuscy: def');

session_start();
$_SESSION['nonce'] = $nonce;
$_SESSION['no'] = $nonce2;
setCookie('no', $nonce2);

@endphp
<script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>
<script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
