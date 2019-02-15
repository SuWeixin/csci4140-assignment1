<?php
// require('vendor/autoload.php');
// // this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
// $s3 = new Aws\S3\S3Client([
//     'version'  => '2006-03-01',
//     'region'   => 'us-east-1',
// ]);
// $bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
?>
<html>
<body>
<?php
    if(isset($_COOKIE['username'])) {
        echo 'You are logged as '.$_COOKIE['username'].'</br>';
        echo '<a href="logout.php"> Log Out </a>';
    }
?>

<p>
    Picture Upload
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</p>

</body>
</html>
