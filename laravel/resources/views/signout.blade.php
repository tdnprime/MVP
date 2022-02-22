<?php 
    session_start();
    session_destroy();
    $config = parse_ini_file( dirname(__DIR__, 3) . "/config/app.ini", true);
    $clientID = $config["google"]["clientID"];
?>
<html>
    <head>
        <meta name="google-signin-client_id" content="<?php echo $clientID; ?>">
    </head>
    <body>
        <div id="container">
        <script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>
        <script>
            
            window.onLoadCallback = function(){
             
                gapi.load('auth2', function() {
                    gapi.auth2.init().then(function(){
                        var auth2 = gapi.auth2.getAuthInstance();
                        auth2.signOut().then(function () {
                            document.location.href = '/out';
                        });
                    });
                });
            };
        </script>
        </div>
    </body>
</html>