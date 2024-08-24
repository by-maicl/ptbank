<?php
include ("../../connect.php");
session_start();

$newUser = $_POST['newUser'];
$usersListRequest = mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$newUser'");

if (mysqli_num_rows($usersListRequest) > 0) {
    $_SESSION['error'] = "<i class='fa-solid fa-circle-xmark'></i> Користувач вже зареєстрований!";
} else {
    mysqli_query($mysql, "INSERT INTO `user` (`login`) VALUES ('$newUser')");
}

mysqli_close($mysql);

header("Location: ../players.php");
exit();

?>