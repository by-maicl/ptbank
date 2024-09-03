<?php
session_start();
include "menu.php";

function balanceCalc($balance, $count = 0)
{
  $balance = explode(".", $balance);
  while ($balance[0] >= 64) {
    $balance[0] = $balance[0] - 64;
    $count++;
  }
  return "$count ст. $balance[0]";
}

function printCardDesign()
{
  return '<div class="cardDesigns">
    <label class="cardDes">
      <input type="radio" name="cardDesign" value="des_green.svg" required style="display:none;">
      <img src="../images/des_cards/des_green.svg" class="cardDesignNewCard">
    </label>
    <label class="cardDes">
      <input type="radio" name="cardDesign" value="des_blue.svg" required style="display:none;">
      <img src="../images/des_cards/des_blue.svg" class="cardDesignNewCard">
    </label>
    <label class="cardDes">
      <input type="radio" name="cardDesign" value="des_red.svg" required style="display:none;">
      <img src="../images/des_cards/des_red.svg" class="cardDesignNewCard">
    </label>
    <label class="cardDes">
      <input type="radio" name="cardDesign" value="des_orange.svg" required style="display:none;">
      <img src="../images/des_cards/des_orange.svg" class="cardDesignNewCard">
    </label>
    <label class="cardDes">
      <input type="radio" name="cardDesign" value="des_pink.svg" required style="display:none;">
      <img src="../images/des_cards/des_pink.svg" class="cardDesignNewCard">
    </label>
    <label class="cardDes">
      <input type="radio" name="cardDesign" value="des_purple.svg" required style="display:none;">
      <img src="../images/des_cards/des_purple.svg" class="cardDesignNewCard">
    </label>
  </div>';
}

function printBalanceChange($request)
{
  if ($request['trans_from'] == $_COOKIE['user']) {
    return "<font color='#B31312'>-$request[trans_sum] ІР</font>";
  } else {
    return "<font color='#4e9f3d'>$request[trans_sum] ІР</font>";
  }
}

function printTransUser($request)
{
  if ($request['trans_from'] == $_COOKIE['user']) {
    return $request['trans_to'];
  } else {
    return $request['trans_from'];
  }
}

function printTransAvaUser($request, $mysql)
{
  if ($request['trans_from'] == $_COOKIE['user']) {
    $userInf = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$request[trans_to]'"));
    return $userInf['ava'];
  } else {
    $userInf = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$request[trans_from]'"));
    return $userInf['ava'];
  }
}

function printCardNumTransInf($request)
{
  if ($request['trans_from'] == $_COOKIE['user']) {
    return $request['card_to'];
  } else {
    return $request['card_from'];
  }
}

function printPenaltyCount($request)
{
  if (empty($request['count'])) {
    return '';
  } else {
    return " ($request[count])";
  }
}

$cardInf = mysqli_query($mysql, "SELECT * FROM `card` WHERE `card_user` = '$_COOKIE[user]'");
$cardInf2 = mysqli_query($mysql, "SELECT * FROM `card` WHERE `card_user` = '$_COOKIE[user]'");
$cardInfMore = mysqli_fetch_assoc($cardInf);
$choiseCardId = $_GET['cId'];

$choiseCardInf = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `card` WHERE `card_id` = '$choiseCardId'"));

$transInf = mysqli_query($mysql, "SELECT * FROM `trans` WHERE `card_from` = '$choiseCardInf[card_number]'  OR `card_to` = '$choiseCardInf[card_number]' AND `trans_from` = '$_COOKIE[user]' OR `trans_to` = '$_COOKIE[user]'  ORDER BY `trans_id` DESC");
$transInfMore = mysqli_fetch_assoc($transInf);

$penaltyCount = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT COUNT(*) as count FROM `penalty` WHERE `penalt_status` = 1 AND `penalt_to` = '$_COOKIE[user]'"));
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <link rel="stylesheet" href="/CSS/bank.css">
  <title>Банк</title>
</head>

<body bgcolor="#191a19">
  <div class="content"> <!--Основная часть сайта-->

    <?php
    if (empty($cardInfMore)):
      echo '<div class="empty-content">
              <p class="empty-text">У вас ще немає картки</p>
              <i class="fa-solid fa-credit-card empty-icon"></i><br>
              <a href="#newCard"><button class="button-green empty-butt">Відкрити картку</button></a>
            </div>';
    else:
      ?>
      <div class="parts">

        <div class="partCard">
          <?php foreach ($cardInf as $cardInf):
            if ($choiseCardId == $cardInf['card_id']):
              ?>
              <div class="cardChoise">
                <div class="cardHeader">
                  <p class="cardName cardNameChoise">
                    <?= $cardInf['card_name'] ?>
                  </p>
                  <div class="cardSettings cardSettingsChoise">
                    <i class="fa-solid fa-pen-to-square" onclick="self.location = '#edit'"></i>
                    <i class="fa-solid fa-trash-can" onclick="self.location = '#del'"></i>
                  </div>
                </div>
                <div class="cardInfChoise">
                  <div>
                    <p class="cardBalanceChoise">
                      <?= $cardInf['card_balance'] ?> ІР
                    </p>
                    <p class="cardBalanceTransfer">
                      <?= balanceCalc($cardInf['card_balance']) ?>
                    </p>
                  </div>
                  <div class="cardDesign" style="background-image: url(../images/des_cards/<?= $cardInf['card_design'] ?>);">
                    <p class="cardNumber"
                      onclick="copyToClipboard(<?= $cardInf['card_number'] ?>, 'Номер карти скопійовано')">
                      <?= $cardInf['card_number'] ?>
                    </p>
                  </div>
                </div>
              </div>

            <?php else: ?>

              <div class="card" onclick="self.location='?cId=<?= $cardInf['card_id'] ?>'">
                <div class="cardInf">
                  <div>
                    <p class="cardName">
                      <?= $cardInf['card_name'] ?>
                    </p>
                    <p class="cardBalance">
                      <?= $cardInf['card_balance'] ?> ІР
                    </p>
                  </div>
                  <div class="cardDesign" style="background-image: url(../images/des_cards/<?= $cardInf['card_design'] ?>);">
                    <p class="cardNumber">
                      <?= $cardInf['card_number'] ?>
                    </p>
                  </div>
                </div>
              </div>
            <?php endif; endforeach; ?>
          <button class="button-grey1" onclick="self.location = '#newCard'"><i class="fa-solid fa-plus"></i></button>
        </div>

        <div class="partTrans">
          <div class="buttons">
            <button class="button-grey1 bankButt" onclick="self.location = '#topUp'"><i
                class="fa-solid fa-arrows-down-to-line"></i><br>
              Поповнити</button>
            <button class="button-grey1 bankButt" onclick="self.location = '#transaction'"><i
                class="fa-solid fa-arrow-right-arrow-left"></i><br>
              Переказати</button>
            <button class="button-grey1 bankButt" onclick="self.location = '#stats'"><i
                class="fa-solid fa-chart-simple"></i><br>
              Статистика</button>
            <button class="button-grey1 bankButt" onclick="self.location = 'penalty.php'"><i
                class="fa-solid fa-money-bills"></i><br>
              Штрафи <?= printPenaltyCount($penaltyCount) ?></button>
          </div>
          <div class="trans">
            <?php
            if (empty($transInfMore)) {
              echo '<div class="empty-content">
                      <p class="empty-text">У вас ще немає транзакцій</p>
                      <i class="fa-solid fa-sack-dollar empty-icon"></i>
                    </div>';
            }
            foreach ($transInf as $transInf):
              ?>
              <div class="transElement" onclick="self.location='#trans-<?= $transInf['trans_id'] ?>'">
                <div class="transElementStyle">
                  <div class="transUserInf">
                    <?php
                    echo '<img src="ava_user/' . printTransAvaUser($transInf, $mysql) . '" class="userAvaTrans">';

                    if (empty($transInf['trans_mess'])) {
                      echo "<p class='nameTrans'>" . printTransUser($transInf) . "</p>";
                    } else {
                      echo "<p class='nameTrans'>" . printTransUser($transInf) . "<br><font color='#828282'>$transInf[trans_mess]</font></p>";
                    }
                    ?>
                  </div>
                  <div class="balanceChange">
                    <?= printBalanceChange($transInf) ?>
                  </div>
                </div>
              </div>

              <div class="windBack" id="trans-<?= $transInf['trans_id'] ?>">
                <div class="wind smallerWind">
                  <div class="wind-mobile">
                    <div class="close-wind-line" onclick="self.location = '#'"></div>
                    <a href="#" class="xmark"><i class="fa-solid fa-xmark"></i></a>
                    <div class="transHeader" onclick="self.location='page.php?login=<?= printTransUser($transInf) ?>'">
                      <img src="ava_user/<?= printTransAvaUser($transInf, $mysql) ?>" class="trans-ava">
                      <p class="wind-header">
                        <?= printTransUser($transInf) ?>
                      </p>
                      <p class="trans-header-date">
                        <?= $transInf['trans_date'] ?>
                      </p>
                    </div>
                    <hr color="#414141" class="hr-trans">
                    <p class="trans-info-balance">
                      <?= printBalanceChange($transInf) ?>
                    </p>
                    <div class="trans-info-basemant">
                      <button class="button-grey2 trans-info-butt"><i class="fa-solid fa-comment"></i>
                        <p>
                          <?php
                          if (empty($transInf['trans_mess'])) {
                            echo "Коментар відсутній";
                          } else {
                            echo $transInf['trans_mess'];
                          }
                          ?>
                        </p>
                      </button>
                      <button class="button-grey2 trans-info-butt"
                        onclick="copyToClipboard(<?= printCardNumTransInf($transInf) ?>, 'Номер карти скопійовано')"><i
                          class="fa-solid fa-credit-card"></i>
                        <p>
                          <?= printCardNumTransInf($transInf) ?>
                        </p>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>
          </div>
        </div>

      </div>

      <div class="windBack" id="topUp"> <!-- Пополнить -->
        <div class="wind windBank">
          <div class="wind-mobile">
            <a href="#" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
            <a href="#" class="xmark"><i class="fa-solid fa-xmark"></i></a>
            <h2 class="wind-header wind-header-indent">Як пововнити рахунок</h2>
            <p class="windText">
              <!-- Рахунок поповнюється у відділеннях банку. Це робить <b>банкір</b>.<br>
              Міста з відділеннями банку:<br> -->
              <b>В розробці</b>
            </p>
            <button onclick="self.location='#'" class="OK">OK</button>
          </div>
        </div>
      </div>

      <div class="windBack" id="transaction"> <!-- Перевод -->
        <div class="wind windBank">
          <div class="wind-mobile">
            <a href="#" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
            <a href="#" class="xmark"><i class="fa-solid fa-xmark"></i></a>
            <h2 class="wind-header wind-header-indent">Переказ</h2>
            <form action="php/transaction.php" method="post" class="wind-transaction">
              <select name="cardFrom" class="pole1">
                <?php
                foreach ($cardInf2 as $cardInfTrans) {
                  echo "<option value='$cardInfTrans[card_number]'>$cardInfTrans[card_name]</option>";
                }
                ?>
              </select>
              <input type="number" name="cardTo" class="pole1" placeholder="Введіть номер карти отримувача" required>
              <input type="number" name="sum" class="pole1" id="trans-sum" placeholder="Введіть суму (0.0)" step="0.1"
                required>
              <input type="text" name="mess" class="pole1" placeholder="Введіть коментар (необов'язково)">
              <?php
              if (isset($_SESSION['error_trans'])) {
                echo '<div class="wind-trans-error">' . $_SESSION['error_trans'] . '</div>';
                unset($_SESSION['error_trans']);
              }
              ?>
              <button type="submit" class="button-green wind-trans-butt">Надіслати</button>
            </form>
          </div>
        </div>
      </div>

      <div class="windBack" id="stats">
        <div class="wind windBank">
          <div class="wind-mobile">
            <a href="#" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
            <a href="#" class="xmark"><i class="fa-solid fa-xmark"></i></a>
            <h2 class="wind-header wind-header-indent">Статистика</h2>
            <div class="stats">
              <div class="stats-el universal-box">
                <p class="stats-header"><i class="fa-solid fa-arrow-right-to-bracket stats-plus-header"></i> Надходження</p>
                <p class="stats-info">1000 ІР</p>
              </div>
              <div class="stats-el universal-box">
                <p class="stats-header"><i class="fa-solid fa-arrow-up-from-bracket"></i> Витрати</p>
                <p class="stats-info stats-info-minus">-1000 ІР</p>
              </div>
            </div>
            <p class="stats-basemant">*вказана інформація за весь час та зі всіх рахунків</p>
            <button onclick="self.location='#'" class="OK">OK</button>
          </div>
        </div>
      </div>

      <div class="windBack" id="edit"> <!-- Изменить счёт -->
        <div class="wind windBank">
          <div class="wind-mobile">
            <a href="#" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
            <a href="#" class="xmark"><i class="fa-solid fa-xmark"></i></a>
            <h2 class="wind-header wind-header-indent">Зміна рахунку</h2>
            <form action="php/editCard.php" method="post">
              <input type="hidden" name="cardId" value="<?= $choiseCardId ?>" required>
              <input type="text" class="pole1" name="cardName" value="<?= $choiseCardInf['card_name'] ?>" maxlength="100"
                placeholder="Введіть назву рахунку" required>
              <p class="cardDesignsHeader">Виберіть дизайн картки:</p>
              <?= printCardDesign() ?>
              <button type="submit" class="OK">ОК</button>
            </form>
          </div>
        </div>
      </div>

      <div class="windBack" id="del"> <!--Удаление счёта-->
        <div class="wind smallerWind">
          <div class="wind-mobile">
            <div class="close-wind-line" onclick="self.location = '#'"></div>
            <h2 class="wind-header small-wind-header">Закрити рахунок?</h2>
            <form action="php/delCard.php" method="post">
              <div class="buttons-confirm">
                <input type="hidden" name="cardId" value="<?= $choiseCardId ?>" readonly required>
                <button type="submit" class="button-grey2 OK"><i class="fa-solid fa-check"></i> Так</button>
                <button type="reset" class="button-grey2 OK" onclick="self.location = '#'"><i
                    class="fa-solid fa-xmark"></i>
                  Ні</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    <?php endif; ?>

    <div class="windBack" id="newCard"> <!-- Новый счёт -->
      <div class="wind windBank">
        <div class="wind-mobile">
          <a href="#" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
          <a href="#" class="xmark"><i class="fa-solid fa-xmark"></i></a>
          <h2 class="wind-header wind-header-indent">Відкриття нового рахунку</h2>
          <form action="php/newCard.php" method="post">
            <input type="text" class="pole1" name="cardName" maxlength="100" placeholder="Введіть назву рахунку"
              required>
            <p class="cardDesignsHeader">Виберіть дизайн картки:</p>
            <?= printCardDesign() ?>
            <button type="submit" class="OK">ОК</button>
          </form>
        </div>
      </div>
    </div>

  </div>

  <script>
    function copyToClipboard(content) {
      var textarea = document.createElement("textarea");
      textarea.value = content;
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand('copy');
      document.body.removeChild(textarea);

      showPopUp("<i class='fa-solid fa-copy'></i> Скопійовано до буферу обміну")
    }
  </script>

</body>

</html>
<?php mysqli_close($mysql); ?>