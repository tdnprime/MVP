<!DOCTYPE html>
<html>
<head>
<title>Boxeon home </title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="icon" type="image/svg+xml" href="../assets/images/favicon.svg">
<link rel="alternate icon" href="../assets/images/favicon.svg">
<link rel="mask-icon" href="https://boxeon.com/images/favicon.svg" color="#fff">
<link rel="stylesheet" href="../assets/css/style.css?v=2">
<link rel="stylesheet" media="screen and (min-width: 200px) and (max-width: 1591px)" href="../assets/css/mobile.css?v=1.0"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open%20Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Concert%20One">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../assets/js/global.js?v=1"></script>
</head>
<body id='home'>
    <div id="progress">
      <div id="bar"></div>
    </div>
    <div id="container">
        <span></span><!-- Hack-->
        <header>
            <a href="#" title="Menu" id='menu-icon'>
	        <span class="material-icons">menu</span></a>
	        <a id='logo' href="/home" title='Boxeon home'>
		    <img id='logo' src='../assets/images/logo.svg' alt='logo'/>
		    <span id="beta">Beta</span></a>
            @auth
            {{-- # DISPLAY AUTHENTICATED USER --}}
                <a id='current-user' href='/box/{{ $user ? $user->id : '0'}}/edit' title='Edit mode'>
                    <span class='material-icons'>account_box</span> {{$user->name}}'s Boxeon
                </a>
            @else
            {{-- # CREATE GOOGLE SIGN-IN URL (DESKTOP)

                /*This sign in URL is being used for desktop signin only.
                For user experience reasons, a sign in URL is generated, marked up,
                and styled for mobile devices.*/ --}}
                <a id='signin' href='{{ url('auth/google') }}'>
                    Sign in with Google
                </a>
            @endauth
        </header>
        {{-- #MENU --}}

        {{-- This is the menu on the left sidebar used by
        customers. Note that the Admin dashboard has its
        own, unique, menu in its left sidebar. --}}

        <div  id="menu" class="menu ">
            <a  id="menu-close" href="#" title='Close'><span class="material-icons">close</span></a>
            <a    href="/"><span class="material-icons">home</span>Home</a>
            <a    href="/box/create"><span class="material-icons">add_box</span>Create box</a>
            <a     href="/box/ship"><span class="material-icons">local_shipping</span>Ship boxes</a>
            <a     href="/partner"><span class="material-icons">group_work</span>Partner</a>
            <a id="signout" class="" href="/signout"><span class="material-icons">logout</span>Sign out</a>
        </div>
        @auth

        @else
        {{-- # CREATE GOOGLE SIGNIN URL (MOBILE) --}}
        <div id='mobile-signin'><a class='signin centered' href='{{ url('auth/google') }}'>
                Sign in with Google
                </a>
        </div>
        @endauth
        {{-- #FEEDBACK
	/*This is the first point of contact in getting feedback from users.
	We present them with an easy to-do first step and once they submit their
	answer, we ask them if they care to tell us why they chose that answers. At this point, their options are "yes" and "no". If they chose "yes" then we show them the feedback form in a modal window. We submit all responses via Ajax.*/ --}}
        <main>
            <section id='left-aside'></section>
            <aside id='panel'>
                <div id='sentiment-survey' class='bg-yellow'>
                    <h1 class='secondary-color'>How do you feel about Boxeon?</h1>
                    <div class='four-col-grid'>
                        <span class='material-icons'>sentiment_neutral</span>
                        <span class='material-icons'>sentiment_satisfied</span>
                        <span class='material-icons'>sentiment_very_satisfied</span>
                        <span class='material-icons'>sentiment_dissatisfied</span>
                    </div>
                </div>

                @yield('content');

            </aside>
            <section id='right-aside'>
            </section>
        </main>
    </div>
    <footer>
        <div id="footer-content-wrapper"> <a>&copy; <?php echo date("Y"); ?> Boxeon, LLC</a>
            <a href="#">Made in the USA with love <img src='../assets/images/heart.svg' alt='heart'/></a>
            <a href="/terms">Terms of use</a>
            <a href="/privacy">Privacy</a>
            <a href="/contact">Contact</a>
            <a href="/about">About</a>
            <a href="/press">Press</a>
        </div>
        <br>
        <img id='footer-logo' class='centered' src='../assets/images/logo.svg' alt='logo'/>
        <p class='centered one-em-font'>548 Market St | San Francisco, CA 94306</p>
        <p class='centered one-em-font'>help@boxeon.com</p>
        <p class='centered one-em-font'>+1-646-450-4671‬</p>
      </footer>

    </div>
</body>
</html>
