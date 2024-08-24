<?php
include("../../connect.php");

$petition_id = $_POST['id'];
$username = $_COOKIE['user'];

$subSel = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `petition` WHERE `id` = '$petition_id'"));
$subUpd = $subSel['subscribe'] + 1;

mysqli_query($mysql, "UPDATE `petition` SET `subscribe` = '$subUpd' WHERE `id` = '$petition_id'");

mysqli_query($mysql, "INSERT INTO `petition_sub` (`petition_id`, `username`) VALUES ('$petition_id', '$username')");

mysqli_close($mysql);
header("Location: ../pw.php?pId=$petition_id&from=$_POST[openFrom]");
?>