<?php
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 include "../connect.php";
 include "menu.php";

 if($_COOKIE['user'] == ''){
   echo "<script>self.location='/index.php';</script>";
 } else { ?>
<!DOCTYPE html>
<html lang="ru">
 <head>
   <link rel="shortcut icon" href="../images/2_green.png" type="image/x-icon">
   <link rel="stylesheet" href="../CSS/menu.css">
   <link rel="stylesheet" href="../CSS/upMenu.css">
   <link rel="stylesheet" href="../CSS/notification.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <script src="https://kit.fontawesome.com/20e02f2fbf.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>
  <script src="script.js"></script>
 </head>
 <body bgcolor="#191a19">
   <div class="content">

     <?php
     $notificationSel1 = mysqli_query($mysql, "SELECT * FROM `notification` WHERE `user_to` = '$_COOKIE[user]' ORDER BY `id` DESC");
     $notificationSel = mysqli_fetch_assoc($notificationSel1);

     if (empty($notificationSel)) {
       echo "<p class='notificationNone' align='center'><i class='fa-solid fa-bell-slash'></i> Сповіщень немає</p>";
     }

     foreach ($notificationSel1 as $notification):

       $selAva1 = mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$notification[user_from]'");
       $selAva = mysqli_fetch_assoc($selAva1);

       $selImg1 = mysqli_query($mysql, "SELECT * FROM `post` WHERE `post_id` = '$notification[object_id]'");
       $selImg = mysqli_fetch_assoc($selImg1);

       $selImgPetition1 = mysqli_query($mysql, "SELECT * FROM `petition` WHERE `id` = '$notification[object_id]'");
       $selImgPetition = mysqli_fetch_assoc($selImgPetition1);

       if ($notification['type'] == 'like') {
      ?>

     <div class="notification" onclick="self.location = 'content.php#<?= $selImg['post_id'] ?>';">
       <div class="notificationStyle">
         <div class="part1">
           <img src="ava_user/<?= $selAva['ava'] ?>" class="notificationAva">
           <p class="notificationName"><b><?= $notification['user_from'] ?></b> вподобав ваш допис <br><font><?= $notification['date'] ?></font></p>
         </div>
         <div class="part2">
           <?php if ($selImg['post_file'] == ""): ?>
             <div class="notificationImg"></div>
           <?php else: ?>
           <img src="post_file/<?= $selImg['post_file'] ?>" class="notificationImg">
           <?php endif; ?>
         </div>
       </div>
     </div>

   <?php } elseif ($notification['type'] == 'comm') { ?>

     <div class="notification" onclick="self.location = 'content.php#<?= $selImg['post_id'] ?>';">
       <div class="notificationStyle">
         <div class="part1">
           <img src="ava_user/<?= $selAva['ava'] ?>" class="notificationAva">
           <p class="notificationName"><b><?= $notification['user_from'] ?></b> коментує: <?= $notification['text'] ?><br><font><?= $notification['date'] ?></font></p>
         </div>
         <div class="part2">
           <?php if ($selImg['post_file'] == ""): ?>
             <div class="notificationImg"></div>
           <?php else: ?>
           <img src="post_file/<?= $selImg['post_file'] ?>" class="notificationImg">
           <?php endif; ?>
         </div>
       </div>
     </div>

   <?php } elseif ($notification['type'] == 'petition') { ?>

     <div class="notification" onclick="self.location = 'petitionSub.php#<?= $selImgPetition['id'] ?>';">
       <div class="notificationStyle">
         <div class="part1">
           <font class="notificationAva"><i class="fa-solid fa-check-to-slot"></i></font>
           <p class="notificationName">Оновлення статусу підсисаної вами петиції<br><font><?= $notification['date'] ?></font></p>
         </div>
         <div class="part2">
           <img src="petition_file/<?= $selImgPetition['file'] ?>" class="notificationImg">
         </div>
       </div>
     </div>

   <?php } elseif ($notification['type'] == 'penalt') { ?>

     <div class="notification" onclick="self.location = 'penalty.php';">
       <div class="notificationStyle">
         <div class="part1">
           <font class="notificationAva"><i class="fa-solid fa-money-bills"></i></font>
           <p class="notificationName"><?= $notification['text'] ?><br><font><?= $notification['date'] ?></font></p>
         </div>
       </div>
     </div>
   <?php }; endforeach; ?>

   </div>

  </div>
 </body>
</html>
<?php } ?>
