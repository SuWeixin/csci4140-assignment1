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

$sql = "SELECT * FROM MyUser where name = '{$name}' and passwords = '{$password}';"

$stmt = $pdo->query($sql);

// $flag = false;
// if ($_POST['username'] == 'admin' && $_POST['password'] == 'minda123') {
//     $flag = true;
// }
// if ($_POST['username'] == 'Alice' && $_POST['password'] == 'csci4140') {
//     $flag = true;
// }

if(isset($_POST['button']) && $stmt->rowCount() != 0){
    setcookie('username',$_POST['username'], time()+36000);
    header('location:homepage.php');
} else {
    header('location:index.php');
}
?>
