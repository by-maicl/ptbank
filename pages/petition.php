<?php
include("../connect.php");
include "menu.php";

if ($_COOKIE['user'] == '') {
  echo "<script>self.location='/index.php';</script>";
} else {
  ?>
  <!DOCTYPE html>
  <html lang="ru">

  <head>
    <link rel="stylesheet" href="/CSS/petition.css">
    <title>Петиції</title>
  </head>

  <body bgcolor="#191a19">


    <div class="content"> <!--Основная часть сайта-->

      <div class="buttons">
        <button class="button currentButt" onclick="self.location = '#'"><i class="fa-solid fa-check-to-slot"></i>
          Діючі</button>
        <button class="button" onclick="self.location = 'myPetition.php'"><i class="fa-solid fa-user-pen"></i> Мої
          петиціїї</button>
        <button class="button" onclick="self.location = 'completePetition.php'"><i class="fa-solid fa-check"></i>
          Завершені</button>
      </div>
      <button class="button newPetitionButt" onclick="self.location = '#newPetition'"><i class="fa-solid fa-plus"></i>
        Створити петицію</button>

      <?php
      $petitionSel = mysqli_query($mysql, "SELECT * FROM `petition` WHERE `status` = 1 ORDER BY `id` DESC");

      foreach ($petitionSel as $petition) {
        $petitionFrom = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT `ava` FROM `user` WHERE `login` = '$petition[username]'"));
        $petitionSub = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `petition_sub` WHERE `petition_id` = '$petition[id]' AND `username` = '$_COOKIE[user]'"));
        ?>

        <div class="petitions">
          <div class="petition" onclick="self.location = 'pw.php?pId=<?= $petition['id'] ?>&from=p'">
            <?php if (isset($petitionSub)) {
              echo '<div class="subPetition">
              <div>Підтримано</div>
              <img src="petition_file/' . $petition['file'] . '" class="petitionImg petitionImgSub">
            </div>';
            } else {
              echo '<img src="petition_file/' . $petition['file'] . '" class="petitionImg">';
            } ?>
            <div class="petitionStyle">
              <p class="petitionHeader"><b>
                  <?= $petition['header'] ?>
                </b></p>
              <div class="petitionBottomFlex">
                <div class="petitionInf">
                  <img src="ava_user/<?= $petitionFrom['ava'] ?>" class="userAvaInf userAva">
                  <div>
                    <b>
                      <?= $petition['username'] ?>
                    </b><br>
                    <font size="2" color="#828282">
                      <?= $petition['date'] ?>
                    </font>
                  </div>
                </div>
                <div class="counter">
                  <div class="petitionSub">
                    <?= $petition['subscribe'] ?> / 5
                  </div>
                  <progress value="<?= $petition['subscribe'] ?>" max="5" class="progress"></progress>
                </div>
              </div>

            </div>
          </div>

        </div>
      <?php } ?>

      <div class="windBack" id="newPetition"> <!--Создание петиции-->
        <div class="wind">
          <a href="#" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
          <a href="#" class="xmark"><i class="fa-solid fa-xmark"></i></a>
          <font color="white" size="5" class="windHeader">Створення петиції</font>
          <form action="php/newPetition.php" method="post" enctype="multipart/form-data">
            <input type="text" name="petitionHeader" required placeholder="Введіть заголовок петиції" class="pole1">
            <textarea name="petitionText" class="pole1 petitionPoleText" placeholder="Введіть текст петиції"
              required></textarea>
            <input id="fileInput" type="file" name="file" accept="image/*" style="display:none;" required>
            <label for="fileInput">
              <p class="OK addImg">Додати зображення</p>
            </label>
            <img id="load">
            <div id="fileWarnSize"></div>
            <div class="warnCreate">*надалі нічого не можна буде змінити</div>
            <button type="submit" class="OK" id="buttSent">Створити</button>
          </form>
        </div>
      </div>

    </div>

    <script type="text/javascript">
      function displayImage(inputId, imageId, warningId) {
        const uploadInput = document.getElementById(inputId);
        const file = uploadInput.files[0];
        const imagePreview = document.getElementById(imageId);
        const warning = document.getElementById(warningId);

        if (file) {
          if (file.size > 2 * 1024 * 1024) {
            warning.innerHTML = 'Файл повинен бути менше 2 МБ';
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

      document.getElementById('fileInput').addEventListener('change', function () {
        displayImage('fileInput', 'load', 'fileWarnSize');
      });
    </script>

  </body>

  </html>
<?php } ?>