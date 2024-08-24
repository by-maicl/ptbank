<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include("../connect.php");
include "menu.php";

if ($_COOKIE['user'] == '') {
  echo "<script>self.location='/index.php';</script>";
} else {

  $userInf = mysqli_query($mysql, "SELECT * FROM `user` ORDER BY `login`");
  ?>
  <!DOCTYPE html>
  <html lang="ru">

  <head>
        <link rel="stylesheet" href="/CSS/search.css">
        <title>Пошук</title>
    </head>

  <body bgcolor="#191a19">

    <div class="content"> <!--Основная часть сайта-->
      <form action="page.php" method="get">
        <div class="searchBar">
          <input list="searchPlayer" type="text" class="pole2 searchInp" name="login" placeholder="Введіть нік того, кого хочете знайти"
            maxlength="50" required>
          <datalist id="searchPlayer">
            <?php foreach ($userInf as $userInf1) { echo '<option value="' . $userInf1['login'] . '">'; } ?>
          </datalist>
          <button type="submit" style="display:none;" id="searchButt"></button>
          <label for="searchButt"><i class="fa-solid fa-magnifying-glass searchButt"></i></label>
        </div>
      </form>

      <?php 
        foreach ($userInf as $userInf):
      ?>
      <div class="userInf" onclick="self.location = 'page.php?login=<?= $userInf['login'] ?>';">
        <div class="userInfStyle">
          <div class="userInfMain">
            <img src="ava_user/<?= $userInf['ava'] ?>">
            <b><?= $userInf['login'] ?></b>
          </div>
          <?= printRole($userInf['role']) ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </body>

  </html>
<?php } ?>