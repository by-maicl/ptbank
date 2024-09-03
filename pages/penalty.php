<?php
include "menu.php";
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
        onclick="self.location = 'bank.php?cId=<?= $bank['card_id'] ?>'"><i
          class="fa-solid fa-chevron-left"></i></button>
      <b>Штрафи</b>
    </p>

    <h2 style="color:white;text-align:center;">Тимчасово недоступно :(</h2>

  </div>

</body>

</html>