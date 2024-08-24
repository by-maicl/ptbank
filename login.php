<?php
include ("connect.php");

if ($_COOKIE['user'] == ''):
  ?>
  <!DOCTYPE html>
  <html lang="ru">

  <head>
    <link rel="shortcut icon" href="images/2_green.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/login.css">
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

    <div class="form">
      <div class="formStyle">
        <p class="header">Вхід</p>
        <form action="validatoin-form/auth.php" method="post">
          <input type="text" name="login" class="pole" placeholder="Нік на сервері" required>
          <input type="password" name="password" class="pole" placeholder="Пароль" required>
          <a href="reg.php">
            <p class="transition">Зареєструватися <i class="fa-solid fa-arrow-right"></i></p>
          </a>
          <button type="submit" class="button">Увійти</button>
        </form>
      </div>
    </div>

    <?php
    session_start();
    if (isset($_SESSION['error'])) {
      echo '<script>showPopUp("<i class=\'fa-solid fa-circle-xmark\'></i> ' . $_SESSION['error'] . '", false);</script>';
      unset($_SESSION['error']);
    }
    ?>

  </body>

  </html>
  <?php
else:
  echo "<script>self.location='/pages/content.php';</script>";
endif;
?>