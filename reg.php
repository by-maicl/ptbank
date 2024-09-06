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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
    <script src="js/pop-up.js"></script>
    <script src="https://kit.fontawesome.com/20e02f2fbf.js" crossorigin="anonymous"></script>
  </head>

  <body bgcolor="#191a19">

    <form action="validation-form/check.php" method="post">
      <div class="box box-reg">
        <div class="part-left">
          <p class="header">Реєстрація</p>
          <p class="errors">
            <?php
            if (isset($_SESSION['error'])) {
              echo $_SESSION['error'];
              unset($_SESSION['error']);
            }
            ?>
          </p>
          <div class="inputs">
            <input type="text" name="login" class="pole1" placeholder="Нікнейм" required>
            <input type="email" name="email" class="pole1" placeholder="Email" required>
            <input type="password" name="password" class="pole1" placeholder="Пароль" required>
          </div>
          <button type="submit" class="button-green button-reg"
            style="width:50%; border-radius:20px;">Зареєструватися</button>
        </div>
        <div class="part-right part-right-reg">
          <p class="header header-color-part">Маєш акаунт?</p>
          <p class="under-header">Авторизуйся та продовжуй грати з друзями</p>
          <a href="login.php"><button type="button" class="button-color-part">Увійти</button></a>
        </div>
      </div>
    </form>

  </body>

  </html>
  <?php
else:
  echo "<script>self.location='/pages/content.php';</script>";
endif;
?>