<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include("../../connect.php");

$description = htmlspecialchars($_POST['description']);
$login = $_COOKIE['user'];

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
    echo "Помилка! Ви ввели не всі дані про посилання.";
} else {
    $linkName = htmlspecialchars($_POST['linkNameNew']);
    $linkUrl = htmlspecialchars($_POST['linkUrlNew']);

    mysqli_query($mysql, "INSERT INTO `user_link` (`login`, `link_name`, `link_url`) VALUES ('$login', '$linkName', '$linkUrl')");
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

mysqli_close($mysql);
header("Location: ../page.php?login=$_COOKIE[user]");
?>