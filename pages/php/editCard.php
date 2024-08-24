<?php
include("../../connect.php");

$cardName = htmlspecialchars($_POST['cardName']);
$cardDesign = $_POST['cardDesign'];
$cardId = $_POST['cardId'];

mysqli_query($mysql, "UPDATE `card` SET `card_name` = '$cardName', `card_design` = '$cardDesign' WHERE `card_id` = '$cardId' AND `card_user` = '$_COOKIE[user]'");

mysqli_close($mysql);
header("Location: ../bank.php?cId=$cardId");
?>