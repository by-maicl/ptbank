<?php
include "menu.php";

$login = htmlspecialchars($_GET['login']);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <link rel="stylesheet" href="/CSS/page.css">
  <title>
    <?= $login ?>
  </title>
</head>

<body bgcolor="#191a19">

  <?php
  function printPost($postInfo)
  {
    foreach ($postInfo as $postPrint) {
      if ($postPrint['post_file'] == null) {
        ?>
        <div class="post" onclick="self.location = 'content.php#<?= $postPrint['post_id'] ?>';">
          <div class='postStyle'>
            <p>
              <?= $postPrint['post_text'] ?>
            </p>
          </div>
        </div>
        <?php
      } else {
        ?>
        <div class="post" onclick="self.location = 'content.php#<?= $postPrint['post_id'] ?>';"
          style="background-image: url(post_file/<?= $postPrint['post_file'] ?>">
          <div class='postStyle'>
            <p></p>
          </div>
        </div>
        <?php
      }
    }
  }

  function printLink($link)
  {
    $linkType = explode("/", $link);
    switch ($linkType[2]) {
      case 'www.youtube.com':
        return '<i class="fa-brands fa-youtube"></i>';

      case 'www.instagram.com':
        return '<i class="fa-brands fa-instagram"></i>';

      case 'github.com':
        return '<i class="fa-brands fa-github"></i>';

      case 't.me':
        return '<i class="fa-brands fa-telegram"></i>';

      default:
        return '<i class="fa-solid fa-link"></i>';
    }
  }
  ?>

  <div class="content"> <!--Основная часть сайта-->

    <?php
    $postInfo1 = mysqli_query($mysql, "SELECT * FROM `post` WHERE `post_from` = '$login' ORDER BY `post_id` DESC");
    $postInfo = mysqli_fetch_assoc($postInfo1);
    $profileLinkInfo = mysqli_query($mysql, "SELECT * FROM `user_link` WHERE `login` = '$login' ORDER BY `id` DESC");
    $profileLinkInfoMore = mysqli_fetch_assoc($profileLinkInfo);

    $pageInfo = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$login'"));
    if (empty($pageInfo)) {
      echo '<div class="empty-content">
                <p class="empty-text">Гравця не знайдно</p>
                <i class="fa-solid fa-user-slash empty-icon"></i><br>
                <a href="search.php"><button class="button-green empty-butt">Повернутись до пошуку</button></a>
              </div>';
      exit();
    }
    ?>

    <div class="blocks">
      <div class="block1">
        <div class="profile">
          <img src="back_user/<?= $pageInfo['back'] ?> " class="profileBack">
          <div class="profileStyle">
            <img src="ava_user/<?= $pageInfo['ava'] ?>" class="profileAvaUser">
            <div class="profileHref">
              <?php
              foreach ($profileLinkInfo as $profileLink) {
                echo "<a href='$profileLink[link_url]' target='_blank'>" . printLink($profileLink['link_url']) . "</a>";
              }
              ?>
            </div>
            <div class="profileHeader">
              <p class="profileName"><b>
                  <?= $pageInfo['login'] ?>
                </b></p>
              <?= printRole($pageInfo['role']) ?>
            </div>
            <p class="profileDescription"><?= $pageInfo['description'] ?></p>
          </div>
        </div>

        <a href="">
          <div class="lives-in universal-box">
            <img src="../images/slide-show/1.png" class="user-ava">
            <p class="city-name"><b>Шиза-сіті</b></p>
          </div>
        </a>

        <?php
        if ($login == $_COOKIE['user']):
          ?>
          <div class="profileButtons">
            <button class="button-grey1" onclick="self.location = '#settings';"><i class="fa-solid fa-gear"></i>
              Налаштування</button>
            <button class="button-grey1" onclick="self.location = '/validation-form/exit.php';"><i
                class="fa-solid fa-door-open"></i> Вийти</button>
          </div>
        <?php endif; ?>
      </div>

      <div class="block2">
        <div class="block2Element">
          <?php
          if (empty($postInfo)) {
            if ($login == $_COOKIE['user']) {
              echo '<div class="empty-content">
                        <p class="empty-text">Ви ще не створили публікації</p>
                        <i class="fa-solid fa-face-frown-open empty-icon"></i><br>
                        <button class="button-green empty-butt" onclick="self.location = \'content.php\';">Створити публікацію</button>
                      </div>';
            } else {
              echo '<div class="empty-content">
                        <p class="empty-text">Гравець ще не створив публікації</p>
                        <i class="fa-solid fa-face-frown-open empty-icon"></i><br>
                      </div>';
            }
          } else { ?>
            <div class="posts">
              <?php echo printPost($postInfo1);
          }
          ?>
          </div>
        </div>
      </div>
    </div>

    <?php
    if ($login == $_COOKIE['user']):
      ?>
      <div class="windBack" id="settings">
        <div class="wind">
          <div class="wind-mobile">
            <a href="#" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
            <a href="#" class="xmark"><i class="fa-solid fa-xmark"></i></a>
            <h2 class="wind-header">Налаштування</h2>
            <div class="profileLine">
              <hr color="#414141">
              <p class="hrText">
                <font class="hrBack">Основне</font>
              </p>
            </div>
            <div class="windImages">
              <div class="windImg">
                <img id="back-preview" src="back_user/<?= $pageInfo['back'] ?>" class="windProfileBack"><br>
                <img id="ava-preview" src="ava_user/<?= $pageInfo['ava'] ?>" class="windProfileAva">
              </div>
              <form action="php/editProfile.php" method="post" enctype="multipart/form-data">
                <input id="back-load" type="file" name="back-file" class="invInput" accept="image/*">
                <input id="ava-load" type="file" name="ava-file" class="invInput" accept="image/*">
                <div class="windEditImg">
                  <label for="back-load">
                    <p class="windEditImgClick">Змінити фонове зображення</p>
                  </label>
                  <label for="ava-load">
                    <p class="windEditImgClick">Змінити аватар</p>
                  </label>
                </div>
            </div>
            <div id="fileWarnSize"></div>
            <textarea name="description" placeholder="Введіть новий опис" class="pole4 windEditDescription"
              maxlength="5000" required><?= $pageInfo['description'] ?></textarea>

            <div class="profileLine">
              <hr color="#414141">
              <p class="hrText">
                <font class="hrBack">Посилання</font>
              </p>
            </div>

            <div class="windLinks">
              <?php
              if (empty($profileLinkInfoMore)) {
                echo '<p align="center" class="windNoLinks">Ви ще нічого не додали сюди<br><i class="fa-solid fa-link-slash"></i></p>';
              } else {

                $linkSql = mysqli_query($mysql, "SELECT * FROM `user_link` WHERE `login` = '$_COOKIE[user]' ORDER BY `id` DESC");
                if ($linkSql->num_rows > 0) {
                  while ($row = $linkSql->fetch_assoc()) {
                    $linkInfo[] = $row;
                  }
                }

                for ($i = 0; $i < count($linkInfo); $i++):
                  ?>
                  <details id="<?= $linkInfo[$i]['id'] ?>">
                    <summary class="windLinkSettings">
                      <?= printLink($linkInfo[$i]['link_url']); ?>
                      <div>
                        <?= $linkInfo[$i]['link_name'] ?><br>
                        <?= $linkInfo[$i]['link_url'] ?>
                      </div>
                    </summary>
                    <div class="windLinksInput">

                      <label class="button-grey2 link-del-butt">
                        <input type="checkbox" name="linkDel-<?= $i + 1 ?>" value="<?= $linkInfo[$i]['id'] ?>"
                          style="display:none;" onclick="hideElement(<?= $linkInfo[$i]['id'] ?>)">
                        <i class="fa-solid fa-trash-can"></i>
                      </label>

                      <input type="text" name="linkName-<?= $i + 1 ?>" placeholder="Введіть назву посилання"
                        class="pole1 inputLink" value="<?= $linkInfo[$i]['link_name'] ?>" maxlength="250" required>

                      <input type="url" name="linkUrl-<?= $i + 1 ?>" placeholder="Вставте посилання" class="pole1 inputLink"
                        value="<?= $linkInfo[$i]['link_url'] ?>" maxlength="250" required>

                      <input type="hidden" name="linkId-<?= $i + 1 ?>" value="<?= $linkInfo[$i]['id'] ?>" readonly required>

                    </div>
                    <hr color="#414141">
                  </details>
                <?php endfor;
              } ?>

              <details id="link"> <!-- Нове посилання -->
                <?php if (empty($profileLinkInfoMore)) {
                  echo '<summary class="OK windLinkNew windLinkNewEmpty">Додати посилання</summary>';
                } else {
                  echo '<summary class="OK windLinkNew">Додати посилання</summary>';
                } ?>
                <div class="windLinksInput">
                  <input type="text" name="linkNameNew" placeholder="Введіть назву посилання" class="pole1 inputLink"
                    maxlength="250">
                  <input type="url" name="linkUrlNew" placeholder="Вставте посилання" class="pole1 inputLink"
                    maxlength="250">
                </div>
                <hr color="#414141">
              </details>
            </div>

            <!-- <div class="profileLine">
                <hr color="#414141">
                <p class="hrText">
                  <font class="hrBack">Безпека</font>
                </p>
              </div>
              <div class="windSafety">
                <p>Для убезпечення вашого аккаунту рекомендовано ввести електронну пошту. В разі чого, за допомогою неї буде
                  скинуто ваш пароль.</p>
                <input type="email" name="email" class="pole1" placeholder="Введіть свій email" required>
              </div> -->
            <button type="submit" class="OK">Зберегти</button>
            </form>
          </div>
        </div>
      </div>
    <?php endif; ?>


  </div>

  <script>

    // Предпросмотр файла
    function displayImage(inputId, imageId, warningId) {
      const uploadInput = document.getElementById(inputId);
      const file = uploadInput.files[0];
      const imagePreview = document.getElementById(imageId);
      const warning = document.getElementById(warningId);

      if (file) {
        if (file.size > 2 * 1024 * 1024) {
          warning.innerHTML = '<br><br>Файл повинен бути менше 2 МБ';
          uploadInput.value = '';
        } else {
          const reader = new FileReader();
          warning.innerHTML = '';
          reader.onload = function (e) {
            imagePreview.src = e.target.result;
          }

          reader.readAsDataURL(file);
        }
      }
    }

    document.getElementById('back-load').addEventListener('change', function () {
      displayImage('back-load', 'back-preview', 'fileWarnSize');
    });
    document.getElementById('ava-load').addEventListener('change', function () {
      displayImage('ava-load', 'ava-preview', 'fileWarnSize');
    });

    function hideElement(el) {
      let element = document.getElementById(el);
      element.style.display = (element.style.display == 'none') ? 'block' : 'none';

      showPopUp("<i class='fa-solid fa-circle-check'></i> Посилання успішно видалено!");
    }

  </script>

</body>

</html>
<?php mysqli_close($mysql); ?>