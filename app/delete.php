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

    $pieces = explode(".", $_COOKIE['imagepath']);
    $id = intval($pieces[0]);
    $postfix = $pieces[1];

    $path = 'image/'.$_COOKIE['imagepath'];
    $tmp_path = 'image/'.intval($id+1).'.'.$postfix;
    if(file_exists($tmp_path)) {
        unlink($tmp_path);
    }

    $sql = "DELETE FROM USERIMAGES WHERE id = $id";
    if($stmt = $pdo->query($sql)) {
        unlink($path);
        if(isset($_COOKIE['imagepath'])) {
            setcookie('imagepath','',time()-3600);
        }
        header('location: homepage.php');
    }
?>