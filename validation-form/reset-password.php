<?php
session_start();
include("../connect.php");

$email = filter_var(trim($_POST['email-password']), FILTER_SANITIZE_STRING);
$userCheck = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `email` = '$email'"));

if (empty($userCheck)) {
    $_SESSION['error'] = "Користувач із вказаною адресою не зареєстрований";
    header('Location: ../password-recowery.php');
    exit();
}

$tempPassword = mt_rand(10000, 99999);
$subject = "Пітухск | Зміна пароля";
$mess = "Ви зробили запит на зміну пароля. Ваш тимчасовий пароль: $tempPassword";

if (mail($email, $subject, $mess)) {
    $_SESSION['success'] = "Повідомлення успішно надіслано";
} else {
    $_SESSION['error'] = "Щось пішло не так: " . mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    header('Location: ../password-recowery.php');
    exit();
}

$tempPassword = md5($tempPassword . "su8ft89er7v");
mysqli_query($mysql, "UPDATE `user` SET `password` = '$tempPassword' WHERE `email` = '$email'");

$mysql->close();
header('Location: ../password-recowery.php');
?>