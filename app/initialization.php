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

    $sql1 = "CREATE TABLE USERIMAGES(id INT PRIMARY KEY, username VARCHAR NOT NULL,
        type VARCHAR NOT NULL, image BYTEA, ts TIMESTAMP, private BOOLEAN);";
    
    $pdo->exec($sql);

    $sql2 = "SELECT * from USERIMAGES;";

    foreach ($pdo->query($sql) as $row) {
        $type = $row['type'];
        // header( "Content-type: $row");
        // echo $row['image']."<br>";
        $path = "image/".$row['id'];
        if ($row['type'] == 'image/jpeg') {
            $path .= '.jpg';
        }
        if ($row['type'] == 'image/gif') {
            $path .= '.gif';
        }
        if ($row['type'] == 'image/png') {
            $path .= '.png';
        }
        if (file_exists($path)) {
            unlink($path);
        }
    }

    $sql3 = "DELETE FROM USERIMAGES";

    $pdo->query($sql3);

    echo 'Initialization completed'.'</br>';
    echo '<a href="homepage.php"> Go Back </a>';
?>