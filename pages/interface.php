<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include("../connect.php");
include "menu.php";

if ($_COOKIE['user'] == '') {
    echo "<script>self.location='/index.php';</script>";
} else {

    $userInf = mysqli_query($mysql, "SELECT * FROM `user`");
    ?>
    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <link rel="stylesheet" href="/CSS/">
        <title>Interface</title>
    </head>

    <body bgcolor="#191a19">

        <div class="content"> <!--Основная часть сайта-->
            <div class="inputs">
                <input type="text" class="pole1" placeholder="pole1">
                <input type="text" class="pole2" placeholder="pole2">
                <input type="text" class="pole3" placeholder="pole3">
                <input type="text" class="pole4" placeholder="pole4">
            </div>
            <div class="buttons">
                <button class="OK">OK</button>
                <button class="button-green">button-green</button>
                <button class="button-grey">button-grey</button>
                <button class="backButt"><i class="fa-solid fa-chevron-left"></i></button>
            </div>
            <div class="modal-wind">
                <a href="#smallWind">Мале вікно</a>
            </div>
        </div>

        <div class="windBack" id="smallWind">
            <div class="wind smallerWind">
                <h2 class="wind-header">Заголовок 1</h2>
                <div class="buttons-confirm">
                    <button type="submit" class="OK"><i class="fa-solid fa-check"></i> Так</button>
                    <button type="reset" class="OK"><i class="fa-solid fa-xmark"></i> Ні</button>
                </div>
            </div>
        </div>

    </body>

    </html>
<?php } ?>