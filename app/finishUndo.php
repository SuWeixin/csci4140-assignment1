<?php
    if(isset($_COOKIE['imagepath'])) {
        setcookie('imagepath','',time()-3600);
    }
    header('location: homepage.php');
?>