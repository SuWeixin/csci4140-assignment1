<?php
$db = parse_url(getenv("DATABASE_URL"));

// $pdo = new PDO("pgsql:" . sprintf(
//     "host=%s;port=%s;password=%s;dbname=%s",
//     $db["host"],
//     $db["port"],
//     $db["user"],
//     $db["pass"],
//     ltrim($db["path"], "/")
// ));

// $name = $_POST['username'];
// $pass = $_POST['password'];

// $sql = "SELECT * FROM MyUser where name = '{$name}' and passwords = '{$pass}';"

// $stmt = $pdo->query($sql);

if(isset($_POST['button']) && $stmt->rowcount() != 0){
    setcookie('username',$_POST['username'], time()+36000);
    header('location:homepage.php');
}
?>
