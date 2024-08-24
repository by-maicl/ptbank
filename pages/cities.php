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
    <link rel="stylesheet" href="/CSS/cities.css">
    <title>Міста</title>
  </head>

  <body bgcolor="#191a19">

    <div class="content"> <!--Основная часть сайта-->
      <input type="color" id="color">
      <label for="color">Вибрати колір міста</label>
    </div>

  </body>

  </html>
<?php } ?>