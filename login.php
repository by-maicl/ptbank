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
    <title>Вхід</title>
    <script src="js/pop-up.js"></script>
    <script src="https://kit.fontawesome.com/20e02f2fbf.js" crossorigin="anonymous"></script>
  </head>

  <body bgcolor="#191a19">

    <form action="validation-form/auth.php" method="post">
      <div class="box">
        <div class="part-left">
          <p class="header">Авторизація</p>
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
            <input type="password" name="password" class="pole1" placeholder="Пароль" required>
          </div>
          <a href="password-recowery.php">
            <p class="link-text">Забули пароль?</p>
          </a>
          <button type="submit" class="button-green" style="width:50%; border-radius:20px;">Увійти</button>
        </div>
        <div class="part-right">
          <p class="header header-color-part">Ще не з нами?</p>
          <p class="under-header">Зареєструйся, щоб отримувати максимальне задоволення від гри</p>
          <a href="reg.php"><button type="button" class="button-color-part">Зареєструватися</button></a>
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