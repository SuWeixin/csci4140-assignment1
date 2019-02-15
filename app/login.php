<?php
$db = parse_url(getenv("DATABASE_URL"));

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));

$name = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM MyUser where name = " + $name + " and passwords = " + $password + ";";

if($stmt = $pdo->query($sql)) {
    if($stmt->fetchColumn() > 0){
        setcookie('username',$_POST['username'], time()+36000);
        header('location:homepage.php');
    } else {
        header('location:index.php');
    }
} else {
    echo $sql;
}


?>
