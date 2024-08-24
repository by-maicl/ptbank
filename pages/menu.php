<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include ("../connect.php");

if ($_COOKIE['user'] == '') {
  echo "<script>self.location='/index.php';</script>";
} else {

  $role = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$_COOKIE[user]'"));
  $bank = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `card` WHERE `card_user` = '$_COOKIE[user]'"));

  function printRole($role)
  {
    switch ($role) {
      case 'admin':
        echo "<div class='profileRoleUser profileRoleAdmin'><b>Адмін</b></div>";
        break;
      case 'bank':
        echo "<div class='profileRoleUser profileRoleBank'><b>Банкір</b></div>";
        break;
      case 'moder':
        echo "<div class='profileRoleUser profileRoleModer'><b>Модератор</b></div>";
        break;
      default:
        echo "<div class='profileRoleUser'><b>Гравець</b></div>";
        break;
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="ru">

  <head>
    <link rel="shortcut icon" href="../images/2_green.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/menu.css">
    <link rel="stylesheet" href="../CSS/upMenu.css">
    <link rel="stylesheet" href="../CSS/pop-up.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://kit.fontawesome.com/20e02f2fbf.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>
    <script src="../js/menu.js"></script>
    <script src="../js/pop-up.js"></script>
  </head>

  <body bgcolor="#191a19">

    <div class="upMenu"> <!-- Верхнее меню -->
      <a href="content.php">
        <div class="upMenuLogo">
          <img src="../images/logo.png" class="logo">
          <p class="logoText">Пітухск</p>
        </div>
      </a>
      <div class="upMenuInf">
        <div class="notifBell" onclick="openNotif('notification')">
          <i class="fa-solid fa-bell"></i>
        </div>
        <img src="ava_user/<?= $role['ava'] ?>" class="ava" onclick="openNotif('user')">
      </div>
    </div>

    <div class="menu"> <!--Меню-->
      <ul>
        <a href="page.php?login=<?= $_COOKIE['user'] ?>">
          <li class="menuButt menuPage"><i class="fa-solid fa-user menuIcon"></i>
            <font class="menuText">Моя сторінка</font>
          </li>
        </a>
        <a href="content.php">
          <li class="menuButt menuContent"><i class="fa-solid fa-house menuIcon"></i>
            <font class="menuText">Головна</font>
          </li>
        </a>
        <a href="bank.php?cId=<?= $bank['card_id'] ?>">
          <li class="menuButt menuBank"><i class="fa-solid fa-building-columns menuIcon"></i>
            <font class="menuText">Банк</font>
          </li>
        </a>
        <a href="petition.php">
          <li class="menuButt menuPetition"><i class="fa-solid fa-check-to-slot menuIcon"></i>
            <font class="menuText">Петиції</font>
          </li>
        </a>
        <!-- <a href="cities.php">
          <li class="menuButt menuСommunities"><i class="fa-solid fa-users menuIcon"></i>
            <font class="menuText">Спільноти</font>
          </li>
        </a> -->
        <a href="cities.php">
          <li class="menuButt menuCities"><i class="fa-solid fa-city menuIcon"></i>
            <font class="menuText">Міста</font>
          </li>
        </a>
        <a href="search.php">
          <li class="menuButt menuSearch"><i class="fa-solid fa-magnifying-glass menuIcon"></i>
            <font class="menuText">Пошук</font>
          </li>
        </a>
        <?php
        if ($role['role'] != 'user') {
          echo '<hr color="#414141" style="margin:0 0 5px 0;">';
        }
        switch ($role['role']) {
          case 'admin':
            echo '<a href="banker.php"><li class="menuButt menuBanker"><i class="fa-solid fa-coins menuIcon"></i> <font class="menuText">Банкірське</font></li></a>
            <a href="players.php"><li class="menuButt menuPlayers"><i class="fa-solid fa-list-ul menuIcon"></i> <font class="menuText">Гравці</font></li></a>';
            break;

          case 'moder':
            echo '<a href="players.php"><li class="menuButt menuPlayers"><i class="fa-solid fa-list-ul menuIcon"></i> <font class="menuText">Гравці</font></li></a>';
            break;

          case 'bank':
            echo '<a href="banker.php"><li class="menuButt menuBanker"><i class="fa-solid fa-coins menuIcon"></i> <font class="menuText">Банкірське</font></li></a>';
            break;
        }
        ?>
        <p align="center" class="version">beta v2.0</p>
      </ul>
    </div>

    <div class="tabletMenu">
      <ul class="tabletMenuList">
        <a href="page.php?login=<?= $_COOKIE['user'] ?>">
          <li class="tabletMenuPart menuPage">
            <i class="fa-solid fa-user tabletMenuIcon"></i>
            <p class="tabletMenuText">Профіль</p>
          </li>
        </a>
        <a href="content.php">
          <li class="tabletMenuPart menuContent">
            <i class="fa-solid fa-house tabletMenuIcon"></i>
            <p class="tabletMenuText">Головна</p>
          </li>
        </a>
        <a href="bank.php?cId=<?= $bank['card_id'] ?>">
          <li class="tabletMenuPart menuBank">
            <i class="fa-solid fa-building-columns tabletMenuIcon"></i>
            <p class="tabletMenuText">Банк</p>
          </li>
        </a>
        <a href="petition.php">
          <li class="tabletMenuPart menuPetition">
            <i class="fa-solid fa-check-to-slot tabletMenuIcon"></i>
            <p class="tabletMenuText">Петиції</p>
          </li>
        </a>
        <a href="search.php">
          <li class="tabletMenuPart menuSearch">
            <i class="fa-solid fa-magnifying-glass tabletMenuIcon"></i>
            <p class="tabletMenuText">Пошук</p>
          </li>
        </a>
      </ul>
    </div>

    <div class="mobMenuLox"> <!--Меню для тел-->
      <ul class="mobMenuList">
        <li class="mobMenuPart"><a href="content.php" class="mobMenuHref"><i class="fa-solid fa-house"></i></a></li>
        <li class="mobMenuPart"><a href="petition.php" class="mobMenuHref"><i class="fa-solid fa-check-to-slot"></i></a>
        </li>
        <li class="mobMenuPart"><a href="bank.php" class="mobMenuHref"><i class="fa-solid fa-building-columns"></i></a>
        </li>
        <li class="mobMenuPart"><a href="players.php" class="mobMenuHref"><i class="fa-solid fa-users"></i></a></li>
        <li class="mobMenuPart"><a href="page.php?login=<?= $_COOKIE['user'] ?>" class="mobMenuHref"><img
              src="ava_user/<?= $role['ava'] ?>" width="25px" height="25px" id="ava"></a></li>
      </ul>
    </div>

    <div class="windNotif" id="notification">
      <p class="windNotifHeader">Сповіщення</p>
      <hr color="#414141">
      <div class="windNotifElement">
        <div class="windNotifElementStyle">
          <div class="windNotifUserInf">
            <img src="ava_user/ava_user.png" class="notifAva">
            <p class="notifText"><b>Username</b><br>Текст сповіщення</p>
          </div>
          <img src="petition_file/Screenshot_2.png" class="notifAva notifImg">
        </div>
      </div>
    </div>

    <div class="windNotif windUser" id="user">
      <div class="windUserButt" onclick="self.location='page.php?login=<?= $_COOKIE['user'] ?>'"><i
          class="fa-solid fa-user windUserIcon"></i>
        <font class="windUserText">Моя сторінка</font>
      </div>
      <div class="windUserButt" onclick="self.location='/validatoin-form/exit.php'"><i
          class="fa-solid fa-door-open windUserIcon"></i>
        <font class="windUserText">Вийти</font>
      </div>
    </div>

    <?php
    if (isset($_SESSION['success'])) {
      echo '<script>showPopUp("' . $_SESSION['success'] . '");</script>';
      unset($_SESSION['success']);
    }

    if (isset($_SESSION['error'])) {
      echo '<script>showPopUp("' . $_SESSION['error'] . '", false);</script>';
      unset($_SESSION['error']);
    }
    ?>

  </body>

  </html>
<?php } ?>