<?php
// $db = parse_url(getenv("DATABASE_URL"));
// echo "hello, db user";

if(isset($_POST['button'])){
    setcookie('username',$_POST['username'], time()+36000);
    header('location:index.php');
}
?>
