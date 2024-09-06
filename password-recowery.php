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
    <title>Відновлення пароля</title>
    <script src="js/pop-up.js"></script>
    <script src="https://kit.fontawesome.com/20e02f2fbf.js" crossorigin="anonymous"></script>
  </head>

  <body bgcolor="#191a19">

    <form action="validation-form/reset-password.php" method="post">
      <div class="box box-password">
        <i class="fa-solid fa-key icon-key"></i>
        <p class="header header-password">Забули пароль?</p>
        <p class="under-header-password">На вказану пошту буде надіслано лист для зміни пароля</p>
        <input type="email" name="email-password" class="pole2" placeholder="Введіть email" required>
        <button type="submit" class="button-green" style="margin-top:20px;">Надіслати</button>
        <?php
        if (isset($_SESSION['error'])) {
          echo '<p class="errors errors-password">' . $_SESSION['error'] . '</p>';
          unset($_SESSION['error']);
        } else if (isset($_SESSION['success'])) {
          echo '<p class="errors success-password">' . $_SESSION['success'] . '</p>';
          unset($_SESSION['success']);
        }
        ?>
      </div>
    </form>

  </body>

  </html>
  <?php
else:
  echo "<script>self.location='/pages/content.php';</script>";
endif;
?>