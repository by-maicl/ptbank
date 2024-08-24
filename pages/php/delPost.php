<?php
session_start();

include("../../connect.php");

$postId = $_POST['postId'];

$request = "DELETE FROM `post` WHERE `post_id` = '$postId'";

if (mysqli_query($mysql, $request)) {
    $_SESSION['error'] = "<i class='fa-solid fa-circle-check'></i> Публікацію успішно видалено";
    header("Location: ../content.php");
} else {
    $_SESSION['error'] = "<i class='fa-solid fa-circle-xmark'></i> Щось пішло не так, спробуйте ще раз";
    $_SESSION['errorType'] = false;
    header("Location: ../content.php");
}

mysqli_close($mysql);
?>