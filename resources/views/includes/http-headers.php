<?php

#CONTENT SECURITY POLICIES 
## Sets content security policies for entire website. DO NOT REMOVE.


#POLICIES
header("Content-Security-Policy: default-src 'self' https://googletagmanager.com https://www.google-analytics.com https://lh3.googleusercontent.com; img-src 'self' http://img.youtube.com https://shippo-static.s3.amazonaws.com https://www.google-analytics.com https://lh3.googleusercontent.com; frame-ancestors 'self'; child-src 'self' https://secure.livechatinc.com https://www.youtube.com; object-src 'self' https://youtube.com; media-src 'self' https://youtube.com https://www.youtube.com; base-uri https://boxeon.com; form-action 'self'; font-src 'self' https://fonts.gstatic.com; style-src 'self' https://fonts.googleapis.com; script-src 'self' https://cdn.livechatinc.com https://api.livechatinc.com https://www.paypal.com https://ajax.googleapis.com https://www.googletagmanager.com https://www.google-analytics.com");
?>