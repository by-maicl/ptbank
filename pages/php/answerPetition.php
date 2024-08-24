<?php
include("../../connect.php");

date_default_timezone_set('Europe/Vilnius');

$petitionId = $_POST['answerPetitionId'];
$answerText = htmlspecialchars($_POST['answerText']);
$support = $_POST['answerBool'];
$date = date('H:i d.m.Y');

mysqli_query($mysql, "UPDATE `petition` SET `status` = 0, `support` = '$support', `answer` = '$answerText', `answer_from` = '$_COOKIE[user]', `answer_date` = '$date' WHERE `id` = '$petitionId'");

$petitonSubSel = mysqli_query($mysql, "SELECT * FROM `petition_sub` WHERE `petition_id` = '$petitionId'");
foreach ($petitonSubSel as $petitonSub) {
  $notificationTo = $petitonSub['username'];

  mysqli_query($mysql, "INSERT INTO `notification` (`object_id`, `user_to`, `type`, `date`) VALUES ('$petitionId', '$notificationTo', 'petition', '$date')");
}

mysqli_close($mysql);
header("Location: ../pw.php?pId=$petitionId&from=c");

?>