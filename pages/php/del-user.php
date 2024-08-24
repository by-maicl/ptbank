<?php
include ("../../connect.php");
session_start();

$userId = $_POST['user-del-id'];

$request = "DELETE FROM `user` WHERE `id` = '$userId'";

if (mysqli_query($mysql, $request)) {
    $_SESSION['success'] = "<i class='fa-solid fa-circle-check'></i> Користувача успішно видалено";
} else {
    $_SESSION['error'] = "<i class='fa-solid fa-circle-xmark'></i> Щось пішло не так!";
}

mysqli_close($mysql);

header("Location: ../players.php");

?>