<?php 
    session_start();
    session_destroy();
?>
<html>
    <head>
        <meta name="google-signin-client_id" content="227887284273-k2b81lp0r79e25vg57vf5kjbnglff49p.apps.googleusercontent.com">
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