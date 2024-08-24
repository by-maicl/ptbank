<?php
include("../connect.php");
include "menu.php";

if ($_COOKIE['user'] == '') {
    echo "<script>self.location='/index.php';</script>";
} else {
    ?>
    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <link rel="stylesheet" href="/CSS/petition.css">
        <title>Петиції</title>
    </head>

    <body bgcolor="#191a19">

        <div class="content"> <!--Основная часть сайта-->
            <?php
            $id = htmlspecialchars($_GET['pId']);

            $openFrom = htmlspecialchars($_GET['from']);

            $role = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$_COOKIE[user]'"));

            $petitionInf = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `petition` WHERE `id` = '$id'"));
            $petitionFrom = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$petitionInf[username]'"));
            $answerFrom = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$petitionInf[answer_from]'"));
            $petitionSub = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `petition_sub` WHERE `petition_id` = '$id' AND `username` = '$_COOKIE[user]'"));

            function printAnswerBool($inf)
            {
                switch ($inf['support']) {
                    case 'true':
                        echo '<div class="answerBoolTrue"><b>Підтримано</b></div>';
                        break;

                    default:
                        echo '<div class="answerBoolFalse"><b>Непідтримано</b></div>';
                        break;
                }
            }
            function bringBack($from)
            {
                switch ($from) {
                    case 'p':
                        return 'petition.php';

                    case 'm':
                        return 'myPetition.php';

                    case 'c':
                        return 'completePetition.php';

                    default:
                        # code...
                        break;
                }
            }
            ?>

            <div class="parts">
                <div class="part1">
                    <p class="petitionInfHeader">
                        <button class="backButt" onclick="self.location = '<?= bringBack($openFrom) ?>'"><i
                                class="fa-solid fa-chevron-left"></i></button>
                        <b>
                            <?= $petitionInf['header'] ?>
                        </b>
                    </p>
                    <img src="petition_file/<?= $petitionInf['file'] ?>" class="petitionInfImg">
                    <?php if ($petitionInf['status'] == 0): ?>
                        <button class="OK supportButt watchAnswerButt" onclick="self.location = '#answer'">Переглянути
                            відповідь</button>
                    <?php endif; ?>
                    <p class="petitionInfWhy">Чому це важливо?</p>
                    <p class="petitionInfText">
                        <?= $petitionInf['text'] ?>
                    </p>

                    <hr color="#414141">
                    <div class="petitionInfBasement"
                        onclick="self.location = 'page.php?login=<?= $petitionInf['username'] ?>'">
                        <img src="ava_user/<?= $petitionFrom['ava'] ?>" class="userAvaInf">
                        <div class="basementElement">
                            <font color="white"><b>
                                    <?= $petitionInf['username'] ?>
                                </b></font><br>
                            <font color="#828282" size="2">
                                <?= $petitionInf['date'] ?>
                            </font>
                        </div>
                    </div>
                </div>
                <div class="part2">
                    <div class="counterInf">
                        <div class="petitionSub petitionInfSub">
                            <?= $petitionInf['subscribe'] ?>
                            <font>5</font>
                        </div>
                        <progress value="<?= $petitionInf['subscribe'] ?>" max="5"
                            class="progress progressPetitionInf"></progress>
                    </div>
                    <?php
                    if ($petitionInf['status'] != 0):
                        if (empty($petitionSub)):
                            ?>
                            <form action="php/suppPetition.php" method="post">
                                <input type="hidden" name="openFrom" value="<?= $openFrom ?>">
                                <input type="hidden" value="<?= $petitionInf['id'] ?>" name="id">
                                <button type="submit" class="OK supportButt">Підтримати</button>
                            </form>
                            <?php
                        else:
                            echo '<button disabled class="OK supportButt supportButtOff">Ви підтримали цю петицію</button>';
                        endif;
                    else:
                        printAnswerBool($petitionInf);
                    endif;

                    if ($role['role'] == 'admin' && $petitionInf['subscribe'] >= 5 && $petitionInf['status'] != 0):
                        ?>
                        <details>
                            <summary>
                                <div class="OK answerButt">Дати відповідь</div>
                            </summary>
                            <div class="answerForm">
                                <form action="php/answerPetition.php" method="post">
                                    <input type="hidden" name="answerPetitionId" value="<?= $petitionInf['id'] ?>">
                                    <select name="answerBool" class="pole1" style="margin-top:5px;">
                                        <option value="true">Підтримано</option>
                                        <option value="false">Непідтримано</option>
                                    </select>
                                    <textarea name="answerText" class="pole1" rows="7" placeholder="Введіть відповідь"
                                        style="margin-top:5px;" required></textarea>
                                    <button type="submit" class="OK supportButt" style="margin-top:0;">Надіслати</button>
                                </form>
                            </div>
                        </details>

                    <?php endif; ?>
                </div>
            </div>

            <?php if ($petitionInf['status'] == 0): ?>
                <div class="windBack" id="answer"> <!--Просмотр ответа-->
                    <div class="wind">
                        <a href="#" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
                        <a href="#" class="xmark"><i class="fa-solid fa-xmark"></i></a>
                        <font color="white" size="5" class="windHeader">Відповідь на петицію #<?= $petitionInf['id'] ?>
                        </font>
                        <p class="answerText">
                            <?= $petitionInf['answer'] ?>
                        </p>
                        <hr color="#414141">
                        <div class="petitionInfBasement"
                            onclick="self.location = 'page.php?login=<?= $petitionInf['answer_from'] ?>'">
                            <img src="ava_user/<?= $answerFrom['ava'] ?>" class="userAvaInf">
                            <div class="basementElement">
                                <font color="white"><b>
                                        <?= $petitionInf['answer_from'] ?>
                                    </b></font><br>
                                <font color="#828282" size="2">
                                    <?= $petitionInf['answer_date'] ?>
                                </font>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </body>

    </html>
<?php } ?>