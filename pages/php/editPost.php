<?php
session_start();

include ("../../connect.php");

$newPostText = htmlspecialchars($_POST['editPostText']);
$postId = $_POST['postId'];

$request = "UPDATE `post` SET `post_text` = '$newPostText' WHERE `post_id` = '$postId'";


if (mysqli_query($mysql, $request)) {
    $_SESSION['error'] = "<i class='fa-solid fa-circle-check'></i> Публікацію успішно змінено";
    header("Location: ../content.php#$postId");
} else {
    $_SESSION['error'] = "<i class='fa-solid fa-circle-xmark'></i> Щось пішло не так, спробуйте ще раз";
    $_SESSION['errorType'] = false;
    header("Location: ../content.php#$postId");
}


mysqli_close($mysql);
?>