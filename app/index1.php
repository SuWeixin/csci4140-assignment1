<?php

require('../vendor/autoload.php');
header('Content-type: image/jpeg');


$image_in = new Imagick('test.jpg');

$image_in->blurImage(10,10);
$image_in->borderImage('black', 100, 100);

echo $image_in;

?>
