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
        <link rel="stylesheet" href="/CSS/banker.css">
        <title>Гравці</title>
    </head>

    <body bgcolor="#191a19">

        <div class="content">

            <?php
            $userInf = mysqli_query($mysql, "SELECT * FROM `user`");
            ?>

            <form action="banker.php" method="get">
                <div class="searchBar">
                    <input list="searchPlayer" type="text" class="pole2 searchInp" name="user"
                        placeholder="Введіть нік гравця" maxlength="50" required>
                    <datalist id="searchPlayer">
                        <?php foreach ($userInf as $users) {
                            echo '<option value="' . $users['login'] . '">';
                        } ?>
                    </datalist>
                    <button type="submit" style="display:none;" id="searchButt"></button>
                    <label for="searchButt"><i class="fa-solid fa-magnifying-glass searchButt"></i></label>
                </div>
            </form>

            <?php
            $userSearch = htmlspecialchars($_GET['user']);
            $userCards = mysqli_query($mysql, "SELECT * FROM `card` WHERE `card_user` = '$userSearch'");

            if (empty($userSearch)) {
                echo '<p class="data-empty-mess" align="center">Введіть запит і тут з\'являться дані</p>';
            } else {
                echo '<p class="data-empty-mess user-info-card">Картки користувача <b>' . $userSearch . '</b>:</p>';
            }

            foreach ($userCards as $userCardsInfo):
                ?>
                <div class="universal-box">
                    <div class="card-box">
                        <div class="card-design"
                            style="background-image: url('../images/des_cards/<?= $userCardsInfo['card_design'] ?>');">
                            <p class="card-num" onclick="copyToClipboard(<?= $userCardsInfo['card_number'] ?>)">
                                <?= $userCardsInfo['card_number'] ?></p>
                        </div>
                        <div class="card-info">
                            <p class="card-name"><?= $userCardsInfo['card_name'] ?></p>
                            <p class="card-balance"><?= $userCardsInfo['card_balance'] ?> ІР</p>
                        </div>
                        <div class="card-action">
                            <button class="button card-butt"
                                onclick="showCardChange('card-plus-<?= $userCardsInfo['card_number'] ?>')"><i
                                    class="fa-solid fa-plus"></i>
                                Поповнити</button>
                            <button class="button card-butt"
                                onclick="showCardChange('card-minus-<?= $userCardsInfo['card_number'] ?>')"><i
                                    class="fa-solid fa-minus"></i> Зняти</button>
                            <button class="button card-butt"
                                onclick="showCardChange('transaction-info-<?= $userCardsInfo['card_number'] ?>')"><i
                                    class="fa-solid fa-money-bill-transfer"></i> Транзакції</button>
                        </div>
                    </div>

                    <form action="php/card-operation.php" method="post" class="form-card-change"
                        id="card-plus-<?= $userCardsInfo['card_number'] ?>">
                        <div class="card-change">
                            <input type="number" name="sum" required class="pole1 pole-card-change"
                                placeholder="Введіть суму поповнення">
                            <input type="hidden" name="cardTo" value="<?= $userCardsInfo['card_number'] ?>" readonly required>
                            <input type="hidden" name="mess" value="Поповнення рахунку. Банкір <?= $_COOKIE['user'] ?>" readonly
                                required>
                            <input type="hidden" name="type" value="0" readonly required>
                            <button type="submit" class="button card-butt pole-card-change">Підтвердити</button>
                        </div>
                    </form>

                    <form action="php/card-operation.php" method="post" class="form-card-change"
                        id="card-minus-<?= $userCardsInfo['card_number'] ?>">
                        <div class="card-change">
                            <input type="number" name="sum" required class="pole1 pole-card-change"
                                placeholder="Введіть суму зняття">
                            <input type="hidden" name="cardTo" value="<?= $userCardsInfo['card_number'] ?>" readonly required>
                            <input type="hidden" name="mess" value="Зняття з рахунку. Банкір <?= $_COOKIE['user'] ?>" readonly
                                required>
                            <input type="hidden" name="type" value="1" readonly required>
                            <button type="submit" class="button card-butt pole-card-change">Підтвердити</button>
                        </div>
                    </form>

                    <div class="transaction-info" id="transaction-info-<?= $userCardsInfo['card_number'] ?>">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Від кого</th>
                                    <th>Кому</th>
                                    <th>Від (карта)</th>
                                    <th>Кому (карта)</th>
                                    <th>Дата</th>
                                    <th>Сума</th>
                                    <th>Повідомлення</th>
                                </tr>
                            </thead>
                            <?php
                            $transInfo = mysqli_query($mysql, "SELECT * FROM `trans` WHERE `card_from` = '$userCardsInfo[card_number]' OR `card_to` = '$userCardsInfo[card_number]' ORDER BY `trans_id` DESC");
                            foreach ($transInfo as $trans):
                                ?>
                                <tr>
                                    <td><?= $trans['trans_id'] ?></td>
                                    <td><?= $trans['trans_from'] ?></td>
                                    <td><?= $trans['trans_to'] ?></td>
                                    <td><?= $trans['card_from'] ?></td>
                                    <td><?= $trans['card_to'] ?></td>
                                    <td><?= $trans['trans_date'] ?></td>
                                    <td><?= $trans['trans_sum'] ?></td>
                                    <td><?= $trans['trans_mess'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>

        <script>
            function showCardChange(form) {
                let element = document.getElementById(form);
                if (element.style.display === 'none' || element.style.display === '') {
                    element.style.display = 'block';
                } else {
                    element.style.display = 'none';
                }
            }

            function copyToClipboard(content) {
                var textarea = document.createElement("textarea");
                textarea.value = content;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);

                showPopUp("<i class='fa-solid fa-copy'></i> Скопійовано до буферу обміну")
            }
        </script>

    </body>

    </html>
<?php endif; ?>