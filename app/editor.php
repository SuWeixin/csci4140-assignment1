<html>
<body>
<?php
    $pieces = explode(".", $_COOKIE['imagepath']);
    $id = $pieces[0];
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
    require('../vendor/autoload.php');
    // header("Content-type: {$type}");
    $tmp_path = 'image/'.intval($id+1).'.'.$postfix;
    if(file_exists($tmp_path)) {
        unlink($tmp_path);
    }

    $path = 'image/'.$_COOKIE['imagepath'];

    // echo $path."<br>";
    // echo $type."<br>";
    // $image_in = new Imagick($path);

    // echo $image_in;
    echo "<a href='$path'> <img src=$path> </a>";
?>
<form id="borderform" name="borderform" method="post" action="border.php">
    <input type="submit" name="borderButton" value="Border" />
</form>
<form id="lomoform" name="lomoform" method="post" action="lomo.php">
    <input type="submit" name="lomoButton" value="Lomo" />
</form>
<form id="lensform" name="lensform" method="post" action="lens.php">
    <input type="submit" name="lensButton" value="Lens Flare" />
</form>
<form id="bwform" name="bwform" method="post" action="bw.php">
    <input type="submit" name="bwButton" value="Black White" />
</form>
<form id="blurform" name="blurform" method="post" action="blur.php">
    <input type="submit" name="blurButton" value="Blur" />
</form>
<form id="undoform" name="undoform" method="post" action="editor.php">
    <input type="submit" name="undoButton" value="Undo" />
</form>
<form id="deleteform" name="deleteform" method="post" action="delete.php">
    <input type="submit" name="deleteButton" value="Delete" />
</form>
<form id="finishform" name="finishform" method="post" action="finishUndo.php">
    <input type="submit" name="finishButton" value="Finish" />
</form>

</body>
</html>