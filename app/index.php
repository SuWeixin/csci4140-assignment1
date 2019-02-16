<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Web Instagram</h2>
    <form id="loginform" name="loginform" method="post" action="login.php">
        Username:<br>
        <input type="text" name="username" id="username">
        <br>
        Password:<br>
        <input type="password" name="password" id="password">
        <br>
        <input type="submit" name="button" id="button" value="Login">
    </form>
    
<?php
require('../vendor/autoload.php');
header('Content-type: image/jpeg');


$image_in = new Imagick('test.jpg');

$image_in->blurImage(10,10);
$image_in->borderImage('black', 100, 100);

echo $image_in;
?>

</body>
</html>