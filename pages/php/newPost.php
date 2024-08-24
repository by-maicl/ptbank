<?php
include ("../../connect.php");

date_default_timezone_set('Europe/Vilnius');
$date = date('H:i d.m.Y');
$postText = htmlspecialchars($_POST['postText']);

$file = $_FILES['postFile'];
$pathFile = '../post_file/' . $file['name'];

if ($file['error'] === UPLOAD_ERR_OK) {
    move_uploaded_file($file['tmp_name'], $pathFile);
    mysqli_query($mysql, "INSERT INTO `post` (`post_date`, `post_from`, `post_text`, `post_file`) VALUES ('$date', '$_COOKIE[user]', '$postText', '$file[name]')");
} else {
    mysqli_query($mysql, "INSERT INTO `post` (`post_date`, `post_from`, `post_text`) VALUES ('$date', '$_COOKIE[user]', '$postText')");
}

mysqli_close($mysql);
header('Location: ../content.php');
?>