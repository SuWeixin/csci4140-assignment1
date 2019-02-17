<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Web Instagram</h2>
    <form id="loginform" name="loginform" method="post" action="login.php">
        Username:<br>
        <input type="text" name="username" id="username">
        <br>
        Password:<br>
        <input type="password" name="password" id="password">
        <br>
        <input type="submit" name="button" id="button" value="Login">
    </form>

    <h3>Public images</h3>

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

        $sql = "SELECT * from USERIMAGES WHERE private = false ORDER BY ts DESC;";

        foreach ($pdo->query($sql) as $row) {
            $type = $row['type'];
            header( "Content-type: $row");
            echo $row['image'];
        }
    ?>

</body>
</html>