<?php include ("connect.php");
$user1 = mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$_COOKIE[user]'");
$user = mysqli_fetch_assoc($user1); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <link rel="shortcut icon" href="images/2_green.png" type="image/x-icon">
  <link rel="stylesheet" href="CSS/index.css">
  <link rel="stylesheet" href="CSS/button.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Правила</title>
  <script src="https://kit.fontawesome.com/20e02f2fbf.js" crossorigin="anonymous"></script>
</head>

<body bgcolor="#191a19">

  <header>
    <div class="upMenuStyle">
      <a href="index.php">
        <div class="upMenuLogo">
          <img src="images/logo.png" class="upMenuImg">
          <p class="upMenuLogoText">Пітухск</p>
        </div>
      </a>
      <div class="upMenuInf">
        <a href="index.php" class="upMenuButt upMenuMain">Головна</a>
        <a href="rules.php" class="upMenuButt upMenuRules">Правила</a>
      </div>
      <?php if (empty($_COOKIE['user'])): ?>
        <button class="button" onclick="self.location = 'login.php'">Увійти</button>
      <?php else: ?>
        <div class="upMenuUser" onclick="self.location = 'pages/content.php'">
          <img src="pages/ava_user/<?= $user['ava'] ?>" class="userAva">
          <p class="userName"><?= $_COOKIE['user'] ?></p>
        </div>
      <?php endif; ?>
    </div>
  </header>

  <div class="rules">
    <p>
      <b>1. ОСНОВНЕ</b><br>
      1.1. Адміністрація не зобов'язана відкочувати будівлі чи повертати речі гравців. Виняток: Втрата речей при
      помилці сервера, або гриферства.<br>
      1.2. Незнання правил не звільняє від відповідальності.<br>
      1.3. Правила можуть змінити у будь-який момент.<br>
      1.4. Адміністрація або Модерація може видати вам покарання з іншої причини, яка не була вказана тут.
      Покладайтеся на власне почуття грамотності та ввічливості.<br>
      1.5. Якщо ви дуже довго не заходите на сервер, то можете бути виключені для звільнення слота під нового
      гравця.<br>
      1.6. Категорично заборонено розповсюджувати: Особисті дані гравців, порнографічний контент, державні
      таємниці.<br><br>

      <b>2. ГРА НА СЕРВЕРІ</b><br>
      2.1. Заборонені будь-які види читів. X-ray ресурс ще так само потрапляють під це правило. Виняток: Клікери не
      вважаються читом.<br>
      2.2. Заборонені дюпи у будь-якому прояві. Виняток: Дюп динаміту, рейок, килимів.<br><br>

      <b>Покарання за правила 2.1 та 2.2:</b><br>
      Попередження. (Невелике порушення)<br>
      Вилучення з вайт-листа. (Середнє порушення)<br>
      Бан по IP. (Важке порушення)<br><br>

      <b>Серйозність порушення визначається адміністрацією, в залежності від події (і наслідків для інших
        гравців).</b><br><br>

      2.3. Заборонено гриферство у будь-якому прояві. Під це правило попадає: Знесення будівель частково чи повністю
      без дозволу власника. Крадіжка предметів. Безглуздий розлив рідин.<br>
      2.4. Заборонено будувати на території фармілок, без дозволу будівельника<br>
      2.5. Заборонено будувати лаг машини. Покарання: Вилучення з вайт-листа.<br><br>

      <b>Покарання за правила 2.3, 2.4:</b><br>
      Внутрішньоігровий розгляд.<br><br>

      2.6. Заборонено перепродувати ігрову валюту за реальні гроші. Покарання: Бан по IP.
    </p>
  </div>

  <hr color="#828282" class="hrBasemant">
  <footer>
    <div class="basemantMediaLogo">
      <div class="upMenuLogo basemantLogo">
        <img src="images/logo.png" class="upMenuImg">
        <p class="upMenuLogoText basemantLogoText">Пітухск</p>
      </div>
      <p class="dateUnderLogo">2019 - <?= date('Y') ?></p>
    </div>
    <div class="basemantMedia basemantPart">
      <p class="basemantHeader">Ми в соціальних мережах</p>
      <a class="mediaList" href="https://www.instagram.com/pityhsk_official/"><i
          class="fa-brands fa-instagram mediaIcon"></i> Instagram</a><br>
      <a class="mediaList" href="https://www.youtube.com/channel/UCq9z9_gdP2oO13QbFSZfKOw"><i
          class="fa-brands fa-youtube mediaIcon"></i> Youtube</a>
    </div>
    <div class="basemantSupport basemantPart">
      <p class="basemantHeader">Зв'язатися з нами</p>
      <a href="mailto:pityhsk@gmail.com">pityhsk@gmail.com</a>
    </div>
  </footer>

</body>

</html>