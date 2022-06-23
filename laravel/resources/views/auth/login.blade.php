
<!DOCTYPE html>
<html lang="en" prefix="og: https://ogp.me/ns#">
<head>
    @include('includes.meta')
</head>

<body>
    <div id="container">
        <span></span><!-- Hack-->
        <div id="masthead">
        <section class="overide card rounded-corners maxw1035px">
            <section class="section margin-top-4-em box-shadow">
                <img class ="center" src="../assets/images/logo-black.png"/>
            <h1 class="primary-color centered extra-large-font">Please sign in to continue</h1>
            <div class="center fit-content">
            <a class="button" href="{{ url('auth/google') }}">
            Sign in with Google
            </a>
            </div>
            <br><br><br>
            </section>
            </section>
        </div>

    </div>
  
</body>
</html>