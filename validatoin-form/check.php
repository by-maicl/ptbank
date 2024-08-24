<?php
session_start();

$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);

$password = md5($password . "su8ft89er7v");

include ("../connect.php");

$check = mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$login'");
$check1 = mysqli_fetch_assoc($check);

if ($check1['password'] == 0) {
  $upd = mysqli_query($mysql, "UPDATE `user` SET `password` = '$password', `email` = '$email' WHERE `login` = '$login'");
} else {
  $_SESSION['error'] = "Користувач вже зареєстрований!";
  header('Location: ../reg.php');
  exit();
}

if (count($check1['login']) == 0) {
  $_SESSION['error'] = "Невірно введені данні!";
  header('Location: ../reg.php');
  exit();
}

$result = $mysql->query("SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$password'");
$user = $result->fetch_assoc();

setcookie('user', $user['login'], time() + 3600 * 24 * 365, "/");

mysqli_close($mysql);
header('Location: ../pages/content.php');
?>