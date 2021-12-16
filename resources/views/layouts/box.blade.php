<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.meta')
</head>

<body id='box' data-new-gr-c-s-check-loaded="8.892.0" data-gr-ext-installed="">
    <div id="progress">
        <div id="bar"></div>
    </div>

    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menu')

        @yield('content')

    </div>
    {{-- NOTE: THIS EMBED IS THE LAST STEP IN CREATING A BOX.  ONCE A USER HAS COMPLETED THE OTHER CREATE BOX WORK, THEY MUST BE
        REDIRECTED TO THEIR BOX/BOXEON AND THEN ASKED TO EMBED A YOUTUBE VIDEO.  THE EMBED UI MUST APPEAR RIGHT WHERE
        THE VIDEO WILL ACTUALLY BE
    <div id="video-place-holder" class="centered">
        <h1 class="extra-large-font">Embed Video</h1>
        <p>Embed a show and tell Youtube video for your subscription box. You may complete
        this step at any time by signing in and clicking on your username.</p>
        <form action="../box/?u=57" method="post" id="embed-form" enctype="multipart/form-data">
        <input required="" placeholder="Youtube video URL from BROWSER" name="ytembed" type="url">
        <div class="buttonHolder">
        <input type="submit" value="Embed"></div></form>
    </div>--}}
    @include('includes.footer')
</body>
</html>
