<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $object_id = $_POST["object_id"];
    $username = $_POST["username"];
    $user_from = $_COOKIE['user'];

    // Перевірте, чи користувач вже ставив лайк
    $sqlSelect = "SELECT * FROM likes WHERE object_id = $object_id AND username = '$username'";
    $result = $mysql->query($sqlSelect);

    if ($result->num_rows > 0) {
        // Якщо вже ставив, заберіть лайк
        $row = $result->fetch_assoc();
        $newLikes = max(0, $row["likes_count"] - 1);
        $sqlUpdate = "UPDATE likes SET likes_count = $newLikes WHERE object_id = $object_id AND username = '$username'";
        $mysql->query($sqlUpdate);
        $sqlDelete = "DELETE FROM likes WHERE object_id = $object_id AND username = '$username'";
        $mysql->query($sqlDelete);

    } else {
        // Якщо не ставив, додайте лайк
        $sqlInsert = "INSERT INTO likes (object_id, username, likes_count) VALUES ($object_id, '$username', 1)";
        $mysql->query($sqlInsert);
    }

    // Отримайте оновлену кількість лайків і виведіть її
    $selLikeUpd1 = mysqli_query($mysql, "SELECT COUNT(*) as count FROM `likes` WHERE `object_id` = '$object_id'");
    $selLikeUpd = mysqli_fetch_assoc($selLikeUpd1);

    if ($selLikeUpd1->num_rows > 0) {
        echo $selLikeUpd['count'];
    }
}

$mysql->close();
?>