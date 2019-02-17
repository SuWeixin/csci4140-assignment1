<html>
<body>
<?php
    if(isset($_COOKIE['username'])) {
        echo 'You are logged as '.$_COOKIE['username'].'</br>';
        echo '<a href="logout.php"> Log Out </a>';
    }
?>

<h3>User Image</h3>
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

    $username = $_COOKIE['username'];

    $sql = "SELECT * from USERIMAGES WHERE username = '{$username}' ORDER BY ts DESC;";

    foreach ($pdo->query($sql) as $row) {
        $type = $row['type'];
        header( "Content-type: $row");
        echo $row['image'].'\n';
        $path = "./image/".$row['id'];
        if ($image_data_type == 'image/jpeg') {
            $path .= 'jpg';
        }
        if ($image_data_type == 'image/gif') {
            $path .= 'gif';
        }
        if ($image_data_type == 'image/png') {
            $path .= 'png';
        }
        echo $path.'\n';
        echo '<img src=$path>';
    }
?>

<h3>Image upload</h3>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <select name="mode">
        <option value="private">Private</option>
        <option value="public">Public</option>
    </select>
    <input type="text" name="imagename" id="imagename">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
