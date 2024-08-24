<?php
include("../../connect.php");

$cardId = $_POST['cardId'];

mysqli_query($mysql, "DELETE FROM `card` WHERE `card_id` = '$cardId' AND `card_user` = '$_COOKIE[user]'");

$return = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `card` WHERE `card_user` = '$_COOKIE[user]'"));

mysqli_close($mysql);
header("Location: ../bank.php?cId=$return[card_id]");
?>