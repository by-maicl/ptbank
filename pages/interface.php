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
                <button class="OK">OK</button><br>
                <button class="button-green">button-green</button><br>
                <button class="button-grey1">button-grey1</button><br>
                <button class="button-grey2">button-grey2</button><br>
                <button class="backButt"><i class="fa-solid fa-chevron-left"></i></button>
            </div>
            <div class="modal-wind">
                <a href="#smallWind">Мале вікно</a><br>
                <a href="#bigWind">Велике вікно</a>
            </div>
        </div>

        <!-- Вікно підтвердження (маленьке) -->
        <div class="windBack" id="smallWind">
            <div class="wind smallerWind">
                <div class="wind-mobile">
                    <div class="close-wind-line" onclick="self.location = '#'"></div>
                    <h2 class="wind-header small-wind-header">Заголовок</h2>
                    <div class="buttons-confirm">
                        <button type="submit" class="button-grey2 OK"><i class="fa-solid fa-check"></i> Так</button>
                        <button type="reset" class="button-grey2 OK" onclick="self.location = '#'"><i
                                class="fa-solid fa-xmark"></i> Ні</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Велике вікно -->
        <div class="windBack" id="bigWind">
            <div class="wind">
                <div class="wind-mobile">
                    <a href="#" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
                    <a href="#" class="xmark"><i class="fa-solid fa-xmark"></i></a>
                    <h2 class="wind-header">Заголовок</h2>
                    <button type="submit" class="OK">Зберегти</button>
                </div>
            </div>
        </div>

    </body>

    </html>
<?php } ?>