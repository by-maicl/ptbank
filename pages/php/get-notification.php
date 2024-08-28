<?php
include("../../connect.php");

$notification = mysqli_query($mysql, "SELECT * FROM `notification` WHERE `user_to` = '$_COOKIE[user]'");

foreach ($notification as $notif): 

    $img = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `$notif[item_table]` WHERE `id` = '$notif[item_id]'"));
    $userAva = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$notif[user_from]'"));
?>

    <div class="wind-notif-el">
        <img src="ava_user/<?= $userAva['ava'] ?>" class="user-ava">
        <div class="wind-notif-info">
            <p><b><?= $notif['user_from'] ?></b> <?= $notif['text'] ?></p>
            <p class="wind-notif-date"><?= $notif['date'] ?></p>
        </div>
        <img src="<?= $notif['item_table'] ?>_file/<?= $img['post_file'] ?>" class="wind-notif-img">
    </div>

<?php endforeach;

mysqli_close($mysql);
?>