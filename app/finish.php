<?php
    $db = parse_url(getenv("DATABASE_URL"));
    $image_username = $_COOKIE['username'];
    $image_upload_mode = 1;

    $pdo = new PDO("pgsql:" . sprintf(
        "host=%s;port=%s;user=%s;password=%s;dbname=%s",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
    ));

    $pieces = explode(".", $_COOKIE['imagepath']);
    $id = intval($pieces[0]) + 1;
    $postfix = $pieces[1];
    $type = '';
    if ($postfix == "jpg") {
        $type = 'image/jpeg';
    }
    if ($postfix == 'gif') {
        $type = 'image/gif';
    }
    if ($postfix == 'png') {
        $type = 'image/png';
    }

    $path = 'image/'.$_COOKIE['imagepath'];

    $image_file = fopen($path, 'r');
    $data = addslashes(fread($image_file, filesize($path)));
    $sql = "INSERT INTO USERIMAGES (id, username, type, ts, private) VALUES 
    ({$id}, '{$image_username}', '{$type}', NOW(), '{$image_upload_mode}');";
    echo $sql;
    if($stmt = $pdo->query($sql)) {
        if(isset($_COOKIE['imagepath'])) {
            setcookie('imagepath','',time()-3600);
        }
        header('location: homepage.php');
    }
?>