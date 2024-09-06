<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include("../../connect.php");

$description = htmlspecialchars($_POST['description']);
$login = $_COOKIE['user'];

$email = htmlspecialchars($_POST['email']);

$fileAva = $_FILES['ava-file'];
$fileBack = $_FILES['back-file'];
$pathAva = '../ava_user/' . $fileAva['name'];
$pathBack = '../back_user/' . $fileBack['name'];

$userInf = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$login'"));
if ($userInf['ava'] != "ava_user.png" || $userInf['back'] != "back_user.png") {
    $oldAva = '../ava_user/' . $userInf['ava'];
    $oldBack = '../back_user/' . $userInf['back'];
}

if (empty($_POST['linkNameNew']) || empty($_POST['linkUrlNew'])) {
    // echo "Помилка! Ви ввели не всі дані про посилання.";
} else {
    $linkName = htmlspecialchars($_POST['linkNameNew']);
    $linkUrl = htmlspecialchars($_POST['linkUrlNew']);

    mysqli_query($mysql, "INSERT INTO `user_link` (`login`, `link_name`, `link_url`) VALUES ('$login', '$linkName', '$linkUrl')");
}

$linkCount = mysqli_num_rows(mysqli_query($mysql, "SELECT * FROM `user_link` WHERE `login` = '$login'"));
for ($i = 1; $i <= $linkCount; $i++) {
    $linkEditName = htmlspecialchars($_POST["linkName-$i"]);
    $linkEditUrl = htmlspecialchars($_POST["linkUrl-$i"]);
    $linkEditId = $_POST["linkId-$i"];

    mysqli_query($mysql, "UPDATE `user_link` SET `link_name` = '$linkEditName', `link_url` = '$linkEditUrl' WHERE `id` = '$linkEditId' AND `login` = '$login'");

    if (isset($_POST["linkDel-$i"])) {
        $linkDel = $_POST["linkDel-$i"];
        mysqli_query($mysql, "DELETE FROM `user_link` WHERE `id` = '$linkDel' AND `login` = '$_COOKIE[user]'");
    }
}

if ($fileAva['error'] === UPLOAD_ERR_OK && $fileBack['error'] === UPLOAD_ERR_OK) {
    unlink($oldAva);
    unlink($oldBack);

    mysqli_query($mysql, "UPDATE `user` SET `description` = '$description', `ava` = '$fileAva[name]', `back` = '$fileBack[name]' WHERE `login` = '$login'");

    move_uploaded_file($fileAva['tmp_name'], $pathAva);
    move_uploaded_file($fileBack['tmp_name'], $pathBack);
} elseif ($fileAva['error'] === UPLOAD_ERR_OK) {
    unlink($oldAva);

    mysqli_query($mysql, "UPDATE `user` SET `description` = '$description', `ava` = '$fileAva[name]' WHERE `login` = '$login'");

    move_uploaded_file($fileAva['tmp_name'], $pathAva);
} elseif ($fileBack['error'] === UPLOAD_ERR_OK) {
    unlink($oldBack);

    mysqli_query($mysql, "UPDATE `user` SET `description` = '$description', `back` = '$fileBack[name]' WHERE `login` = '$login'");

    move_uploaded_file($fileBack['tmp_name'], $pathBack);
} else {
    mysqli_query($mysql, "UPDATE `user` SET `description` = '$description' WHERE `login` = '$login'");
}

mysqli_query($mysql, "UPDATE `user` SET `email` = '$email' WHERE `login` = '$login'");

mysqli_close($mysql);
header("Location: ../page.php?login=$_COOKIE[user]");
?>