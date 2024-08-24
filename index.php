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
  <title>Пітухск - приватний майнкрафт сервер</title>
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
        <a href="mods.php" class="upMenuButt upMenuMain">Моди</a>
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

  <div class="content">
    <img src="images/parlament.png" class="contentBack">
    <p class="contentHeader">
      <font class="contentHeaderLead">Пітухск</font> - це приватний майнкрафт сервер,<br>заснований на грі з друзями
      без
      грифів та приватів
    </p>
    <a href="#start">
      <button class="button startGame">Почати грати</button>
    </a>
  </div>

  <div class="aboutServer">
    <p class="infoServer">Трішки з життя серверу</p>
    <div class="slideshow-container">
      <div class="slides fade">
        <img src="images/slide-show/1.png" style="width:100%">
      </div>
      <div class="slides fade">
        <img src="images/slide-show/2.png" style="width:100%">
      </div>
      <div class="slides fade">
        <img src="images/slide-show/3.png" style="width:100%">
      </div>
      <div class="slides fade">
        <img src="images/slide-show/4.png" style="width:100%">
      </div>
      <div class="slides fade">
        <img src="images/slide-show/5.png" style="width:100%">
      </div>

      <div class="dots">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
        <span class="dot" onclick="currentSlide(5)"></span>
      </div>
      <p class="modList">
        На нашому сервері панує дружня атмосфера. Івенти, спільні проєкти та торгівля, як приклад цьому.<br>
        Стань політиком - або абстрогуйся від світу, будуй своє місто - або живи в чийомусь.<br>
        Роби що завгодно, але дотримуйся правил.<br>
        <b>Приєднуйся до нас прямо зараз!</b>
      </p>
    </div>

  </div>

  <div class="startPlay" id="start">
    <h1 class="startPlayHeader">Як почати грати</h1>
    <p class="startPlayInfo">Для початку гри на нашому сервері Вам необхідно виконати 3 прості кроки:</p>
    <p class="startPlayInfo">
      1. Подайте заявку на приєднання до серверу. В ній необхідно відповісти на декілька простих
      запитань. Заявка розглядається адміністрацією протягом 24-х годин, після чого вам надійде повідомлення в Діскорд
      про її статус.
    </p>
    <button class="button startPlayButt" onclick="self.location = 'application.php'"><i class="fa-solid fa-pencil"></i> Подати заявку</button>
    <p class="startPlayInfo">
      2. Після схвалення вашої заявки необхідно зареєструватись на сайті. Для цього натисніть кнопку "Увійти" у
      верхньому меню сторінки та виберіть "Зареєструватися".
    </p>
    <p class="startPlayInfo">
      3. Встановіть збірку серверу, скориставшись розділом "Збірка". Ви також можете скористатись <u><a
          href="pages/server-install.php">цим</a></u> посиланням. Приємної гри!
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

  <script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
      let i;
      let slides = document.getElementsByClassName("slides");
      let dots = document.getElementsByClassName("dot");
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > slides.length) { slideIndex = 1 }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
      setTimeout(showSlides, 5000);
    }

    function currentSlide(n) {
      slideIndex = n;
      showSlides();
    }
  </script>

</body>

</html>