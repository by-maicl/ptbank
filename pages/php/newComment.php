<?php
include("../../connect.php");

$commFrom = mysqli_real_escape_string($mysql, $_POST['username']);
$commText = mysqli_real_escape_string($mysql, htmlspecialchars($_POST['comment']));
$postId = intval($_POST['postId']); // Переконайтесь, що postId є числом

$date = date('H:i d.m.Y');

mysqli_query($mysql, "INSERT INTO post_comment (username, comment, date, post_id) VALUES ('$commFrom', '$commText', '$date', $postId)");

echo json_encode(["status" => "success", "message" => "Коментар успішно додано"]);

mysqli_close($mysql);

?>
