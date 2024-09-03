<?php
session_start();
include("connect.php");

if ($_COOKIE['user'] == ''):
  ?>
  <!DOCTYPE html>
  <html lang="ru">

  <head>
    <link rel="shortcut icon" href="images/2_green.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/interface.css">
    <link rel="stylesheet" href="CSS/pop-up.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід</title>
    <script src="js/pop-up.js"></script>
    <script src="https://kit.fontawesome.com/20e02f2fbf.js" crossorigin="anonymous"></script>
  </head>

  <body bgcolor="#191a19">

    <div class="parent-box">
      <div class="box">
        <h1 class="box-header">Вхід</h1>
        <form action="validation-form/auth.php" method="post">
          <div class="input-box">
            <input type="text" name="login" class="pole1" placeholder="Нік на сервері" required>
            <input type="password" name="password" class="pole1" placeholder="Пароль" required>
          </div>
          <p class="p-link">Не пам'ятаю пароль</p>

          <?php
          if (isset($_SESSION['error'])) {
            echo '<div class="errors">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
          }
          ?>

          <button type="submit" class="button-green butt-box">Увійти</button>
        </form>
        <p class="p-link basemant-link">Зареєструватись</p>
      </div>
    </div>

  </body>

  </html>
  <?php
else:
  echo "<script>self.location='/pages/content.php';</script>";
endif;
?>