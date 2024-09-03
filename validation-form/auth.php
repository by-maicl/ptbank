<?php
session_start();
include("../connect.php");

$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
$password = md5($password . "su8ft89er7v");

$user = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$password'"));

if (empty($user)) {
  $_SESSION['error'] = "Невірний нік чи пароль!";
  header('Location: ../login.php');
  exit();
}

setcookie('user', $user['login'], time() + 3600 * 24 * 365, "/");

$mysql->close();
header('Location: ../pages/content.php');
?>