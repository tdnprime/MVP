<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.meta');
</head>

<body id='box' data-new-gr-c-s-check-loaded="8.892.0" data-gr-ext-installed="">
    <div id="progress">
        <div id="bar"></div>
    </div>

    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header');
        @include('includes.menu');

        @yield('content');

    </div>
    <div id="video-place-holder" class="centered">
        <h1 class="extra-large-font">Embed Video</h1>
        <p>Embed a show and tell Youtube video for your subscription box. You may complete
        this step at any time by signing in and clicking on your username.</p>
        <form action="../box/?u=57" method="post" id="embed-form" enctype="multipart/form-data">
        <input required="" placeholder="Youtube video URL from BROWSER" name="ytembed" type="url">
        <div class="buttonHolder">
        <input type="submit" value="Embed"></div></form>
    </div>
    @include('includes.footer');
</body>
</html>
