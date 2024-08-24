<?php
include("../../connect.php");

date_default_timezone_set('Europe/Vilnius');
$date = date('H:i d.m.Y');
$header = htmlspecialchars($_POST['petitionHeader']);
$text = htmlspecialchars($_POST['petitionText']);


$file = $_FILES['file'];
$pathFile = '../petition_file/' . $file['name'];
move_uploaded_file($file['tmp_name'], $pathFile);


mysqli_query($mysql, "INSERT INTO `petition` (`header`, `text`, `file`, `date`, `username`) VALUES ('$header', '$text', '$file[name]', '$date', '$_COOKIE[user]')");

mysqli_close($mysql);
header('Location: ../petition.php');
?>