<!DOCTYPE html>
<html lang="en">
<head>
<title>Best way for creators to get sustainable income and connect with fans | Boxeon</title>
<meta name="description" content="Start and grow a subscription box business and secure monthly income without making extra content. It's the wave of the future."/>
<meta name="keywords" content="Boxeon, Patreon alternative, monitize content, Subscription box platform, make more money on Youtube">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="icon" type="assets/image/svg+xml" href="assets/images/favicon.svg">
<link rel="alternate icon" href="assets/images/favicon.svg">
<link rel="mask-icon" href="https://boxeon.cassets/images/favicon.svg" color="#fff">
<link rel="stylesheet" href="assets/css/style.css?v=2">
<link rel="stylesheet" media="screen and (min-width: 200px) and (max-width: 1320px)" href="assets/css/mobile.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open%20Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Concert%20One">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="assets/js/global.js?v=1"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-211880503-1">
</script>
</head>

<body id='index'>
    <div id="container">
        <span></span><!-- Hack-->
        <header>
            <a href="#" title="Menu" id='menu-icon'>
            <img src="assets/images/menu.svg" alt="Menu"></a>
            <a id='logo' href="/" title='Home'>
            <img src="assets/images/logo.svg" alt="logo"/>
            <span id="beta">Beta</span></a>

            @auth

            <a id='current-user' href='/box/?u=$uid' title='Edit mode'>
                <span class='material-icons'>account_box</span> {{$user->name}}'s Boxeon
            </a>

            @else
            <a id='signin' href='{{ url('auth/google') }}'>
                Sign in with Google
            </a>

            @endauth
        </header>

            <div  id="menu" class="menu">
                <a id="m-close" class="fadein menu-close" href="#">X</a>
                <a class="fadein" href="/">Home</a>
                <a class="fadein" href="/home/?q=l">Creators guide</a>
                <a class="fadein" href="/partner">Partner</a>
                <a class="fadein" href="/commission">Commission</a>
                <a class="fadein" href="/box/create">Create box</a>
                <a class="fadein" href="{{ route('box.edit',$user->id) }}">Edit box</a>
                <a class="fadein" href="/home/?s=s">Ship boxes</a>
                    <a class="fadein" href="/home/?i=i">Income</a>
                    <a class="fadein" href="/blog">Academy</a>
                    <a class="fadein"  href="/?mb=mb">Account</a>
                <a class="fadein" id="signout" href="/signout">Sign out</a>
            </div>

            <div id='mobile-signin'><a class='signin centered' href='{{ url('auth/google') }}'>
                Sign in with Google
                </a></div>
            @yield('content')

    </div>
    <footer>
        <div id="footer-content-wrapper">
            <a>&copy; <?php echo date("Y"); ?> Boxeon, Inc</a>
              <a href="#">Made in the USA with love <img src='assets/images/heart.svg' alt='heart'/></a>
            <a href="/terms">Terms of use</a>
            <a href="/privacy">Privacy</a>
            <a href="/contact">Contact</a>
            <a href="/about">About</a>
            <a href="/press">Press</a>
          </div>
          <br>
          <img id='footer-logo' class='centered' src='assets/images/logo.svg' alt='logo'/>
          <p class='centered one-em-font'>548 Market St | San Francisco, CA 94306</p>
          <p class='centered one-em-font'>subscriptions@boxeon.com</p>
          <p class='centered one-em-font'>+1-646-450-4671‬</p>
    </footer>
    <noscript><a href="https://www.livechatinc.com/chat-with/13262328/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
</body>
</html>
