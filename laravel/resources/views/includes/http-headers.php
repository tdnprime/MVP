<?php
function makeRandomString($bits = 256) {
    $bytes = ceil($bits / 8);
    $return = '';
    for ($i = 0; $i < $bytes; $i++) {
        $return .= chr(mt_rand(0, 255));
    }
    return $return;
}
$hash =  hash('sha512', makeRandomString());
setcookie('hash', $hash);
header("Content-Security-Policy: default-src 'self' https://www.google-analytics.com https://nd.squarecdn.com https://pci-connect.squareupsandbox.com https://www.googleanalytics.com; img-src 'self' https://lh3.googleusercontent.com http://img.youtube.com https://shippo-static.s3.amazonaws.com; frame-ancestors 'self'; child-src 'self' https://nd.squarecdn.com https://accounts.google.com/ https://www.youtube.com; object-src 'self' https://youtube.com; media-src 'self' https://youtube.com https://www.youtube.com; base-uri https://boxeon.com; form-action 'self'; font-src 'self' https://fonts.gstatic.com; style-src 'self' 'unsafe-inline' https://sandbox.web.squarecdn.com https://fonts.googleapis.com; frame-src 'self' https://youtube.com https://connect.squareupsandbox.com https://sandbox.web.squarecdn.com/ https://www.youtube.com; script-src 'self' '$hash' https://nd.squarecdn.com https://js.squareupsandbox.com http://www.googletagmanager.com https://sandbox.web.squarecdn.com https://apis.google.com https://ajax.googleapis.com");
