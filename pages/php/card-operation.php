<?php
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


$operation = $_POST['type'];

date_default_timezone_set('Europe/Vilnius');
$date = date('H:i d.m.Y');

$sum = $_POST['sum'];
$mess = htmlspecialchars($_POST['mess']);

$cardFrom = 1111;
$cardTo = $_POST['cardTo'];

$cardFromInfo = "Пітухбанк";
$cardToInfo = getCardInfo($mysql, $cardTo);

mysqli_query($mysql, "INSERT INTO `trans` (`trans_from`, `trans_to`, `card_from`, `card_to`, `trans_date`, `trans_sum`, `trans_mess`) VALUES ('$cardFromInfo', '$cardToInfo[card_user]', '$cardFrom', '$cardTo', '$date', '$sum', '$mess')");
changeBalance($mysql, $cardToInfo, $sum, $operation);

mysqli_close($mysql);
header("Location: ../banker.php?user=$cardToInfo[card_user]");
?>