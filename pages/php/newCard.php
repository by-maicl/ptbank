<?php
include("../../connect.php");

$cardName = htmlspecialchars($_POST['cardName']);
$cardDesign = $_POST['cardDesign'];
$cardNumber = mt_rand(1000, 9999);

mysqli_query($mysql, "INSERT INTO `card` (`card_name`, `card_user`, `card_number`, `card_design`) VALUES ('$cardName', '$_COOKIE[user]', '$cardNumber', '$cardDesign')");

$return = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `card` ORDER BY `card_id` DESC"));
$return = $return['card_id']++;

mysqli_close($mysql);
header("Location: ../bank.php?cId=$return");
?>