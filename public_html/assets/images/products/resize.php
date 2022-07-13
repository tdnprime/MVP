<?php

$path = './';
$files = scandir($path);
$files = array_diff(scandir($path), array('.', '..'));

foreach ($files as $file) {

    $re = explode(".", $file);
    $name =  "medium/" . $re[0] . ".jpeg";
   

    if (exif_imagetype($file) == 3) { // png

        $image = imagecreatefrompng($file);
        $imgResized = imagescale($image, 320, 466);
        imagejpeg($imgResized, $name);

    } else if (exif_imagetype($file) == 2) { //  jpeg

        $image = imagecreatefromjpeg($file);
        $imgResized = imagescale($image, 320, 466);
        imagejpeg($imgResized, $name);

    } elseif (exif_imagetype($file) == 18) { // webp

        $image = imagecreatefromwebp($file);
        $imgResized = imagescale($image, 320, 466);
        imagejpeg($imgResized, $name);

    }

}
