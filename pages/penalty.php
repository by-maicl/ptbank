<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include("../connect.php");
include "menu.php";

if ($_COOKIE['user'] == '') {
  echo "<script>self.location='/index.php';</script>";
} else {

  $cardInf = mysqli_query($mysql, "SELECT * FROM `card` WHERE `card_user` = '$_COOKIE[user]'");
  $cardInf2 = mysqli_fetch_assoc($cardInf);
  $penalties = mysqli_query($mysql, "SELECT * FROM `penalty` WHERE `penalt_to` = '$_COOKIE[user]' AND `penalt_status` = 1");
  $penalties2 = mysqli_fetch_assoc($penalties);

  ?>
  <!DOCTYPE html>
  <html lang="ru">

  <head>
    <link rel="stylesheet" href="/CSS/bank.css">
    <title>Штрафи</title>
  </head>

  <body bgcolor="#191a19">

    <div class="content"> <!--Основная часть сайта-->

      <p class="penaltyBack"><button class="backButt"
          onclick="self.location = 'bank.php?cId=<?= $cardInf2['card_id'] ?>'"><i
            class="fa-solid fa-chevron-left"></i></button>
        <b>Штрафи</b>
      </p>

      <?php
      if (empty($penalties2)) {
        echo '<p align="center" style="color: #828282">
        У вас поки що немає штрафів<br>
        <i class="fa-regular fa-face-laugh-beam warnIcon"></i>
      </p>';
      }
      ?>


      <div class="penalties">
        <?php foreach ($penalties as $penalties): ?>
          <div class="penalty">
            <p class="penaltyHeader">Штраф #
              <?= $penalties['penalt_id'] ?>
            </p>
            <table>
              <tr>
                <td class="penaltyInfHeader">Від:</td>
                <td>
                  <?= $penalties['penalt_from'] ?>
                </td>
              </tr>
              <tr>
                <td class="penaltyInfHeader">Причина:</td>
                <td>
                  <?= $penalties['penalt_text'] ?>
                </td>
              </tr>
              <tr>
                <td class="penaltyInfHeader">Сума:</td>
                <td>
                  <?= $penalties['penalt_sum'] ?> ІР
                </td>
              </tr>
              <tr>
                <td class="penaltyInfHeader">Дата:</td>
                <td>
                  <?= $penalties['penalt_date'] ?>
                </td>
              </tr>
            </table>
            <button class="button payButt" onclick="self.location='#pay-<?= $penalties['penalt_id'] ?>'">Сплатити</button>
          </div>

          <div class="windBack" id="pay-<?= $penalties['penalt_id'] ?>"> <!-- Оплата штрафа -->
            <div class="wind">
              <a href="#" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
              <a href="#" class="xmark"><i class="fa-solid fa-xmark"></i></a>
              <font color="white" size="5" class="windHeader">Оплата штрафу #
                <?= $penalties['penalt_id'] ?>
              </font>
              <form action="php/transaction.php" method="post">
                <div class="transWind">
                  <input type="hidden" name="from" value="penalty">
                  <input type="hidden" name="id" value="<?= $penalties['penalt_id'] ?>">
                  <select name="cardFrom" class="pole1">
                    <?php
                    foreach ($cardInf as $cardInfTrans) {
                      echo "<option value='$cardInfTrans[card_number]'>$cardInfTrans[card_name]</option>";
                    }
                    ?>
                  </select>
                  <input type="hidden" name="cardTo" value="<?= $penalties['penalt_card_from'] ?>" readonly>
                  <input type="number" name="sum" class="pole1" step="0.1" value="<?= $penalties['penalt_sum'] ?>" readonly>
                  <input type="text" name="mess" class="pole1" value="Оплата штрафу #<?= $penalties['penalt_id'] ?>"
                    readonly>
                </div>
                <button type="submit" class="OK">ОК</button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>

  </body>

  </html>
<?php } ?>