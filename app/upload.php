<?php
if (isset($_POST['submit'])) {
    $image_username = $_COOKIE['username'];
    $image_data_name = $_FILES['fileToUpload']['name'];
    $image_data_size = $_FILES['fileToUpload']['size'];
    $image_data_type = $_FILES['fileToUpload']['type'];
    $image_data = $_FILES['fileToUpload']['tmp_name'];
    $image_upload_mode = 1;

    if ($_POST['mode'] == 'public') {
        $image_upload_mode = 0;
    }

    $filename = $_POST['imagename'];
    // $array = str_split($filename);
    // foreach ($array as $char) {
    //     if ($)
    // }

    if(!preg_match('/[^a-z_\-0-9]/i', $filename))
    {
        if ($filename != ' ') {
            header('location:nameerror.php');
        }
    }

    if ($image_data_type != 'image/jpeg' && $image_data_type != 'image/gif' && $image_data_type != 'image/png') {
        header('location:typeerror.php');
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

        $sql1 = "SELECT * FROM USERIMAGES ORDER BY id DESC;";
        if ($stmt1 = $pdo->query($sql1)) {
            $image_id = 1;
            if ($stmt1->fetchColumn() != 0) {
                foreach ($pdo->query($sql1) as $row) {
                    if ($row['id'] >= $image_id) {
                        $image_id = $row['id'] + 1;
                    }
                }
                // $id_bucket = $stmt1->fetchAll(1);
                // $image_id = $stmt1->fetchColumn(0) + 1;
            }
            
            $data = addslashes(fread(fopen($image_data, "r"), filesize($image_data_size)));
            $sql2 = "INSERT INTO USERIMAGES (id, username, type, image, ts, private) VALUES 
                    ({$image_id}, '{$image_username}', '{$image_data_type}', '{$data}', NOW(), '{$image_upload_mode}');";
                    
            echo $sql2;
            if ($pdo->query($sql2)) {
                $new_file_name = $image_id;
                if ($image_data_type == 'image/jpeg') {
                    $new_file_name = $new_file_name.'.jpg';
                }
                if ($image_data_type == 'image/gif') {
                    $new_file_name = $new_file_name.'.gif';
                }
                if ($image_data_type == 'image/png') {
                    $new_file_name = $new_file_name.'.png';
                }
                move_uploaded_file($image_data, './image/'.$new_file_name);
                setcookie("imagepath", $new_file_name);
                header('location:editor.php');
            }
        }
    }
}
?>