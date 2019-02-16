<?php
if (isset($_POST['submit'])) {
    $image_username = $_COOKIE['username'];
    $image_data_name = $_FILES['fileToUpload']['name'];
    $image_data_size = $_FILES['fileToUpload']['size'];
    $image_data_type = $_FILES['fileToUpload']['type'];
    $image_data = $_FILES['fileToUpload']['tmp_name'];
    $image_upload_mode = true;

    if ($_POST['mode'] == 'public') {
        $image_upload_mode = false;
    }

    if ($image_data_type != 'image/jpeg' && $image_data_type != 'image/gif' && $image_data_type != 'image/png') {
        header('location:homepage.php');
    } else {
        $db = parse_url(getenv("DATABASE_URL"));

        $pdo = new PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));

        $sql1 = "SELECT id FROM USERIMAGES ORDER BY id DESC;";
        if ($stmt1 = $pdo->query($sql1)) {
            $image_id = 0;
            if ($stmt1->fetchColumn() != 0) {
                // $id_bucket = $stmt1->fetchAll();
                $image_id = $stmt + 1;
            }
            
            $data = addslashes(fread(fopen($image_data, "r"), filesize($image_data_size)));
            $sql2 = "INSERT INTO USERIMAGES (id, username, type, image, ts, private) VALUES 
                    ({$image_id}, '{$image_username}', '{$image_data_type}', '{$data}', NOW(), '{$image_upload_mode}');";
                    
            echo $sql2;
            if ($pdo->query($sql2)) {
                header('location:homepage.php');
            }
        }
    }
}
?>