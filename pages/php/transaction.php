<?php
session_start();
include("../../connect.php");

function getCardInfo($mysql, $cardNum)
{
    $result = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `card` WHERE `card_number` = '$cardNum'"));
    return $result;
}

function changeBalance($mysql, $card, $sum, $operation = 0)
{
    // 0 - плюс
    // 1 - минус
    switch ($operation) {
        case 0:
            $updBal = $card['card_balance'] + $sum;
            mysqli_query($mysql, "UPDATE `card` SET `card_balance` = '$updBal' WHERE `card_number` = '$card[card_number]'");
            break;

        default:
            $updBal = $card['card_balance'] - $sum;
            mysqli_query($mysql, "UPDATE `card` SET `card_balance` = '$updBal' WHERE `card_number` = '$card[card_number]'");
            break;
    }
}


$cardFrom = $_POST['cardFrom'];
$cardTo = $_POST['cardTo'];

$cardFromInfo = getCardInfo($mysql, $cardFrom);
$cardToInfo = getCardInfo($mysql, $cardTo);

if (empty($cardToInfo)) {
    $_SESSION['error_trans'] = "Невірний номер картки отримувача";
    echo "<script>self.location='../bank.php?cId=$cardFromInfo[card_id]#transaction';</script>";
    exit();
}

date_default_timezone_set('Europe/Vilnius');
$date = date('H:i d.m.Y');

$sum = $_POST['sum'];
$mess = htmlspecialchars($_POST['mess']);

if ($cardFromInfo['card_balance'] < $sum) {
    $_SESSION['error_trans'] = "На вашому рахунку недостатньо коштів";
    echo "<script>self.location='../bank.php?cId=$cardFromInfo[card_id]#transaction';</script>";
    exit();
}

mysqli_query($mysql, "INSERT INTO `trans` (`trans_from`, `trans_to`, `card_from`, `card_to`, `trans_date`, `trans_sum`, `trans_mess`) VALUES ('$cardFromInfo[card_user]', '$cardToInfo[card_user]', '$cardFrom', '$cardTo', '$date', '$sum', '$mess')");

changeBalance($mysql, $cardFromInfo, $sum, 1);
changeBalance($mysql, $cardToInfo, $sum);

if (isset($_POST['from'])) {
    mysqli_query($mysql, "UPDATE `penalty` SET `penalt_status` = 0 WHERE `penalt_id` = '$_POST[id]'");
}

mysqli_close($mysql);
header("Location: ../bank.php?cId=$cardFromInfo[card_id]");
?>