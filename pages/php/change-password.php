<?php
include("../../connect.php");
session_start();

$oldPass = htmlspecialchars($_POST['oldPassword']);
$newPass = htmlspecialchars($_POST['newPassword']);

$oldPass = md5($oldPass . "su8ft89er7v");

$passRequest = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$_COOKIE[user]'"));

if ($oldPass != $passRequest['password']) {
    $_SESSION['error-pass'] = 'Невірний пароль';
    header("Location: ../page.php?login=$_COOKIE[user]#change-password");
    exit();
}

$newPass = md5($newPass . "su8ft89er7v");

mysqli_query($mysql, "UPDATE `user` SET `password` = '$newPass' WHERE `login` = '$_COOKIE[user]'");

mysqli_close($mysql);
header("Location: ../page.php?login=$_COOKIE[user]");

?>