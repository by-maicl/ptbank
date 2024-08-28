<?php
session_start();

include("../../connect.php");

$postId = $_POST['postId'];

$postComplaintCount = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT `post_complaint` FROM `post` WHERE `post_id` = '$postId'"));
$postComplaintCount['post_complaint'] += 1;

$request = "UPDATE `post` SET `post_complaint` = '$postComplaintCount[post_complaint]' WHERE `post_id` = '$postId'";

if (mysqli_query($mysql, $request)) {
    $_SESSION['success'] = "<i class='fa-solid fa-circle-check'></i> Скаргу успішно надіслано. Дякуємо!";
    header("Location: ../content.php#$postId");
} else {
    $_SESSION['error'] = "<i class='fa-solid fa-circle-xmark'></i> Щось пішло не так, спробуйте ще раз";
    $_SESSION['errorType'] = false;
    header("Location: ../content.php#$postId");
}

mysqli_close($mysql);
?>