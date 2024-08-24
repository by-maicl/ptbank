<?php
include ("../../connect.php");
session_start();

$username = htmlspecialchars($_POST['username']);
$password = $_POST['password'];
$role = $_POST['user-role'];
$userId = $_POST['user-id'];

mysqli_query($mysql, "UPDATE `user` SET `login` = '$username', `role` = '$role' WHERE `id` = '$userId'");

if ($password) {
    mysqli_query($mysql, "UPDATE `user` SET `password` = NULL WHERE `id` = '$userId'");
}

$_SESSION['success'] = "<i class='fa-solid fa-circle-check'></i> Дані успішно змінено";

mysqli_close($mysql);

header("Location: ../players.php");

?>