<?php 
#Signout
session_start();
session_unset();
session_destroy();
// Browser session is cleared in browser
$config = parse_ini_file( "config/app.ini", true );
?>
<html>
    <head>
        <meta name="google-signin-client_id" content=<?php echo $config["google"]["clientID"]; ?>>
    </head>
    <body>
        <script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>
        <script>
            window.onLoadCallback = function(){
                gapi.load('auth2', function() {
                    gapi.auth2.init().then(function(){
                        var auth2 = gapi.auth2.getAuthInstance();
                        auth2.signOut().then(function () {
                            document.location.href = '/index.php';
                        });
                    });
                });
            };
        </script>
    </body>
</html>