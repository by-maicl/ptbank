<?php
include("../connect.php");
include "menu.php";

if ($_COOKIE['user'] == '') {
  echo "<script>self.location='/index.php';</script>";
} else {

  $login = htmlspecialchars($_GET['login']);
  if (empty($login)) {
    echo "<script>self.location='search.php'</script>";
  }
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
    $pageInfo = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$login'"));
    $postInfo1 = mysqli_query($mysql, "SELECT * FROM `post` WHERE `post_from` = '$login' ORDER BY `post_id` DESC");
    $postInfo = mysqli_fetch_assoc($postInfo1);
    $profileLinkInfo = mysqli_query($mysql, "SELECT * FROM `user_link` WHERE `login` = '$login' ORDER BY `id` DESC");
    $profileLinkInfoMore = mysqli_fetch_assoc($profileLinkInfo);

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
            <div class="gradient-border">
              <div class="lives-in universal-box">
                <img src="../images/slide-show/1.png" class="user-ava">
                <p class="city-name"><b>Шиза-сіті</b></p>
              </div>
            </div>
          </a>

          <?php
          if ($login == $_COOKIE['user']):
            ?>
            <div class="profileButtons">
              <button class="button-grey1" onclick="self.location = '#settings';"><i class="fa-solid fa-gear"></i>
                Налаштування</button>
              <button class="button-grey1" onclick="self.location = '/validatoin-form/exit.php';"><i
                  class="fa-solid fa-door-open"></i> Вийти</button>
            </div>
          <?php endif; ?>
        </div>

        <div class="block2">
          <div class="block2Element">
            <?php
            if (empty($postInfo)) {
              if ($login == $_COOKIE['user']) { ?>
                <div class="postClear">
                  <p>Ви ще не створили жодної публікації</p>
                  <i class="fa-regular fa-face-frown" id="postClearIcon"></i><br>
                  <button class="button-green postClearButt" onclick="self.location = 'content.php';">Створити
                    публікацію</button>
                </div>
              <?php } else {
                echo '<div class="postClear">
              <p>Гравець ще не створив жодної публікації</p>
              <i class="fa-regular fa-face-frown" id="postClearIcon"></i>';
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
                }
                foreach ($profileLinkInfo as $profileLink):
                  ?>
                  <details id="<?= $profileLink['id'] ?>">
                    <summary class="windLinkSettings">
                      <?= printLink($profileLink['link_url']); ?>
                      <div>
                        <?= $profileLink['link_name'] ?><br>
                        <?= $profileLink['link_url'] ?>
                      </div>
                    </summary>
                    <div class="windLinksInput">
                      <label class="button linkDelButt">
                        <input onclick="toggle(document.getElementById('<?= $profileLink['id'] ?>'))" type="checkbox"
                          name="linkDel-<?= $profileLink['id'] ?>" class="invInput"><i class="fa-solid fa-trash-can"></i>
                      </label>
                      <input type="text" name="linkName-<?= $profileLink['id'] ?>" placeholder="Введіть назву посилання"
                        class="pole1 inputLink" value="<?= $profileLink['link_name'] ?>" maxlength="250" required>
                      <input type="url" name="url-<?= $profileLink['id'] ?>" placeholder="Вставте посилання"
                        class="pole1 inputLink" value="<?= $profileLink['link_url'] ?>" maxlength="250" required>
                    </div>
                    <hr color="#414141">
                  </details>
                <?php endforeach; ?>

                <details id="link">
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

      function toggle(el) {
        el.style.display = (el.style.display == 'none') ? 'block' : 'none';
      }

    </script>

  </body>

  </html>
  <?php
}
mysqli_close($mysql);
?>