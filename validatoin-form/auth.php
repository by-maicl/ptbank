<?php
session_start();

$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

$password = md5($password . "su8ft89er7v");

include ("../connect.php");
$result = $mysql->query("SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$password'");
$user = $result->fetch_assoc();
if (count($user) == 0) {
  $_SESSION['error'] = "Невірний нік чи пароль!";
  header('Location: ../login.php');
  exit();
}

setcookie('user', $user['login'], time() + 3600 * 24 * 365, "/");

$mysql->close();
header('Location: ../pages/content.php');
?>