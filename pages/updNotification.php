<?php

include "../connect.php";

$upd = mysqli_query($mysql, "UPDATE `notification` SET `status` = 0 WHERE `status` = 1 AND `user_to` = '$_COOKIE[user]'");

mysqli_close($mysql);
 ?>
