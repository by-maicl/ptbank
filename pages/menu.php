<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include("../connect.php");

if ($_COOKIE['user'] == ''):
  echo "<script>self.location='/index.php';</script>";
else:

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
        <div class="notif-elements" onclick="openWindow('notification')">
          <i class="fa-solid fa-bell notif-bell" id="loadNotification"></i>
          <div class="unread-notif-dot"></div>
        </div>
        <img src="ava_user/<?= $role['ava'] ?>" class="ava" onclick="openWindow('user')">
      </div>
    </div>

    <div class="menu"> <!--Меню-->
      <ul>
        <a href="page.php?login=<?= $_COOKIE['user'] ?>">
          <li class="menuButt menuPage"><i class="fa-solid fa-user menuIcon"></i>
            <font class="menuText">Профіль</font>
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
        <a href="group.php">
          <li class="menuButt menuGroup"><i class="fa-solid fa-users menuIcon"></i>
            <font class="menuText">Спільноти</font>
          </li>
        </a>
        <a href="petition.php">
          <li class="menuButt menuPetition"><i class="fa-solid fa-check-to-slot menuIcon"></i>
            <font class="menuText">Петиції</font>
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
        <p align="center" class="version">v2.1.0</p>
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

    <div class="mobile-menu">
      <ul class="mobile-menu-list">
        <a href="content.php">
          <li class="mobile-menu-part">
            <i class="fa-solid fa-house"></i>
            <p class="mobile-menu-text">Головна</p>
          </li>
        </a>
        <a href="bank.php?cId=<?= $bank['card_id'] ?>">
          <li class="mobile-menu-part">
            <i class="fa-solid fa-building-columns"></i>
            <p class="mobile-menu-text">Банк</p>
          </li>
        </a>
        <a href="petition.php">
          <li class="mobile-menu-part">
            <i class="fa-solid fa-check-to-slot"></i>
            <p class="mobile-menu-text">Петиції</p>
          </li>
        </a>
        <a href="search.php">
          <li class="mobile-menu-part">
            <i class="fa-solid fa-magnifying-glass"></i>
            <p class="mobile-menu-text">Пошук</p>
          </li>
        </a>
        <li class="mobile-menu-part">
          <i class="fa-solid fa-bars burger-butt" onclick="openMenu()" id="burgerClose"></i>
          <i class="fa-solid fa-xmark burger-butt" onclick="openMenu()" id="burgerOpen" style="display:none;"></i>
          <p class="mobile-menu-text">Ще</p>
        </li>
      </ul>
    </div>

    <div class="wind-notif" id="notification">
      <p class="wind-notif-header">Сповіщення</p>
      <hr color="#414141">

      <div id="notifOutput"></div>

      <!-- <div class="wind-notif-el" id="notification">
        <img src="ava_user/ava_user.png" class="user-ava">
        <div class="wind-notif-info">
          <p><b>Maicl_GraB</b> вподобав(-ла) ваш допис</p>
          <p class="wind-notif-date">12:36 27.08.2024</p>
        </div>
        <img src="post_file/photo_2024-08-26_19-58-17.jpg" class="wind-notif-img">
      </div>

      <div class="wind-notif-el">
        <img src="ava_user/ava_user.png" class="user-ava">
        <div class="wind-notif-info">
          <p><b>Maicl_GraB</b> коментує ваш допис: Ахалай махалай</p>
          <p class="wind-notif-date">12:36 27.08.2024</p>
        </div>
        <img src="post_file/photo_2024-08-26_19-58-17.jpg" class="wind-notif-img">
      </div>

      <div class="wind-notif-el">
        <i class="fa-solid fa-check-to-slot user-ava wind-notif-icon"></i>
        <div class="wind-notif-info">
          <p>Оновлення статусу вашої петиції</p>
          <p class="wind-notif-date">12:36 27.08.2024</p>
        </div>
        <img src="post_file/photo_2024-08-26_19-58-17.jpg" class="wind-notif-img">
      </div>

      <div class="wind-notif-el">
        <i class="fa-solid fa-check-to-slot user-ava wind-notif-icon"></i>
        <div class="wind-notif-info">
          <p>Оновлення статусу підписаної вами петиції</p>
          <p class="wind-notif-date">12:36 27.08.2024</p>
        </div>
        <img src="post_file/photo_2024-08-26_19-58-17.jpg" class="wind-notif-img">
      </div> -->

    </div>

    <div class="wind-notif wind-user" id="user">
      <button class="button-grey2 wind-user-butt" onclick="self.location='page.php?login=<?= $_COOKIE['user'] ?>'"><i
          class="fa-solid fa-user"></i> Профіль</button>
      <button class="button-grey2 wind-user-butt"
        onclick="self.location='page.php?login=<?= $_COOKIE['user'] ?>#settings'"><i class="fa-solid fa-gear"></i>
        Налаштування</button>
      <button class="button-grey2 wind-user-butt" onclick="self.location='/validation-form/exit.php'"><i
          class="fa-solid fa-door-open"></i> Вийти</button>
    </div>

    <!-- <div class="burger-menu-back" id="burgerMenu" style="display:none;">
      <div class="burger-menu universal-box">
        <div class="burger-menu-style">
          <a href=""><button class="button-grey2"><i class="fa-solid fa-user"></i> Профіль</button></a>
          <a href=""><button class="button-grey2"><i class="fa-solid fa-users"></i> Спільноти</button></a>
        </div>
      </div>
    </div> -->

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
<?php endif; ?>