<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include "../connect.php";
include "menu.php";

if ($_COOKIE['user'] == ''):
    echo "<script>self.location='/index.php';</script>";
else: ?>
    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <link rel="stylesheet" href="/CSS/players.css">
        <title>Гравці</title>
    </head>

    <body bgcolor="#191a19">

        <div class="content">
            <div class="user addUser" onclick="self.location = '#add-user'"><i class="fa-solid fa-user-plus"></i> Додати
                користувача</div>

            <?php
            $getUsers = mysqli_query($mysql, "SELECT * FROM `user` ORDER BY `login`");
            foreach ($getUsers as $user):
                ?>

                <div class="user">
                    <div class="userInfo">
                        <img src="ava_user/<?= $user['ava'] ?>" class="avaUser">
                        <p class="username"><?= $user['login'] ?></p>
                    </div>
                    <?php printRole($user['role']); ?>
                    <div class="actions">
                        <a href="page.php?login=<?= $user['login'] ?>"><i class="fa-solid fa-user actionsButt"></i></a>
                        <a href="#change-user-<?= $user['id'] ?>"><i class="fa-solid fa-pen-to-square actionsButt"></i></a>
                        <a href="#delete-player-<?= $user['id'] ?>"><i class="fa-solid fa-trash-can delUser"></i></a>
                    </div>
                </div>

                <div class="windBack" id="change-user-<?= $user['id'] ?>">
                    <div class="wind windUserChange">
                        <a href="#" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
                        <a href="#" class="xmark"><i class="fa-solid fa-xmark"></i></a>
                        <div class="windHeader">Користувач <B><?= $user['login'] ?></B></div>
                        <form action="php/change-player.php" method="post">
                            <input type="text" name="username" class="pole1" required placeholder="Введіть новий нікнейм"
                                value="<?= $user['login'] ?>">
                            <label>
                                <input type="checkbox" name="password" class="resetPasswordInp">
                                <div class="pole1 resetPassword">Скинути пароль <i
                                        class="fa-solid fa-circle-check passwordCheckMark"></i></div>
                            </label>
                            <hr color="#414141" class="hrChangeUser">
                            <select name="user-role" class="pole1">
                                <option value="<?= $user['role'] ?>"><?= $user['role'] ?></option>
                                <option value="admin">Адмін</option>
                                <option value="moder">Модератор</option>
                                <option value="bank">Банкір</option>
                                <option value="user">Гравець</option>
                            </select>
                            <input type="hidden" readonly name="user-id" value="<?= $user['id'] ?>">
                            <button type="submit" class="OK">Зберегти</button>
                        </form>
                    </div>
                </div>

                <div class="windBack" id="delete-player-<?= $user['id'] ?>">
                    <div class="wind smallerWind">
                        <div class="windHeader" align="center">Видалити <b><?= $user['login'] ?></b>?</div>
                        <p class="deleteUserInfo">
                            Увага! Це остаточне видалення з сайту. Впевніться, що ви все правильно робите.
                        </p>
                        <form action="php/del-user.php" method="post">
                            <div class="buttonDel">
                                <button type="submit" class="OK"><i class="fa-solid fa-check"></i> Так</button>
                                <button type="reset" class="OK" onclick="self.location='#'"><i class="fa-solid fa-xmark"></i>
                                    Ні</button>
                            </div>
                            <input type="hidden" name="user-del-id" required readonly value="<?= $user['id'] ?>">
                        </form>
                    </div>
                </div>

            <?php endforeach; ?>

            <div class="windBack" id="add-user">
                <div class="wind smallerWind">
                    <a href="#" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
                    <a href="#" class="xmark"><i class="fa-solid fa-xmark"></i></a>
                    <div class="windHeader">Новий користувач</div>
                    <form action="php/add-player.php" method="post">
                        <input type="text" name="newUser" class="pole1" required placeholder="Введіть нікнейм">
                        <button type="submit" class="OK">Додати</button>
                    </form>
                </div>
            </div>

        </div>

        <?php
        if (isset($_SESSION['success'])) {
            echo '<script>showPopUp("' . $_SESSION['success'] . '");</script>';
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
            echo '<script>showPopUp("' . $_SESSION['error'] . '", false);</script>';
            unset($_SESSION['error']);
        }


        ?>

    </body>

    </html>
<?php endif; ?>