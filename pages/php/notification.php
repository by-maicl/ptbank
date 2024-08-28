<?php
function addNotification($mysql, $type, $from, $to, $text, $itemTable, $itemId)
{
    date_default_timezone_set('Europe/Vilnius');
    $date = date('H:i d.m.Y');
    $request = "INSERT INTO `notification` (`type`, `user_from`, `user_to`, `text`, `date`, `item_table`, `item_id`) VALUES ('$type', '$from', '$to', '$text', '$date', '$itemTable', '$itemId')";
    mysqli_query($mysql, $request);
}

?>