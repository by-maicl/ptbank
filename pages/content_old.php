<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include "../connect.php";
include "menu.php";

if ($_COOKIE['user'] == '') {
  echo "<script>self.location='/index.php';</script>";
} else { ?>
  <!DOCTYPE html>
  <html lang="ru">

  <head>
    <link rel="stylesheet" href="/CSS/content_old.css">
    <title>Головна</title>
    <script src="../js/content.js"></script>
    <script src="../js/likes.js"></script>
  </head>


  <body bgcolor="#191a19">

    <div class="content"> <!--Основная часть сайта-->

      <div class="blocks">
        <div class="sort">
          Стара версія головної сторінки
        </div>

        <?php
        $post_sel = mysqli_query($mysql, "SELECT * FROM `post` ORDER BY `post_id` DESC");
        $post_sel1 = mysqli_fetch_assoc($post_sel);
        ?>

        <div class="block1">

          <form action="php/newPost.php" method="post" enctype="multipart/form-data">
            <div class="newPost">
              <div class="newPostStyle">
                <img src="ava_user/<?= $role['ava'] ?>" id="avaPost">
                <textarea type="text" name="postText" class="pole2 newPostPole"
                  placeholder="Що нового, <?= $_COOKIE['user'] ?>?" rows="1" required></textarea>
                <input id="postFile" type="file" name="postFile" accept="image/*" style="display:none;">
                <label for="postFile">
                  <i class="fa-solid fa-image newPostSend" style="margin-right:5px;"></i>
                </label>
                <button type="submit" id="newPostButt" style="display:none;"></button>
                <label for="newPostButt"><i class="fa-solid fa-arrow-right newPostSend"></i></label>
              </div>
            </div>
          </form>

          <!--Посты-->
          <?php
          foreach ($post_sel as $posts) {

            $postFrom1 = mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$posts[post_from]'");
            $postFrom = mysqli_fetch_assoc($postFrom1);

            $commCount1 = mysqli_query($mysql, "SELECT COUNT(*) as count FROM `post_comm` WHERE `post_id` = '$posts[post_id]'");
            $commCount = mysqli_fetch_assoc($commCount1);
            ?>

            <div class="post" id="<?= $posts['post_id'] ?>">
              <div class="postStyle">
                <font class="postHeader2Mob">
                  <font color="white" size="4" class="postHeaderMob">
                    <a href="page.php?login=<?= $posts['post_from'] ?>">
                      <img src="ava_user/<?= $postFrom['ava'] ?>" id="avaPost">
                      <B class="postFrom">
                        <?= $posts['post_from'] ?>
                      </B>
                    </a>
                    <font color="grey" class="postDateMob">
                      <?= $posts['post_date'] ?>
                    </font>
                  </font>
                  <div class="balls" onclick="self.location = 'content.php#doPost-<?= $posts['post_id'] ?>'"><i
                      class="fa-solid fa-ellipsis"></i></div>
                  <div class="balls ballsMob" onclick="self.location = 'content.php#doPost-<?= $posts['post_id'] ?>'"><i
                      class="fa-solid fa-ellipsis-vertical"></i></div>
                </font>
                <!-- <br class="invBr"> -->
                <font color="grey" size="2" class="postDate">
                  <?= $posts['post_date'] ?>
                </font>
                <br class="invBr">

                <?php
                if ($posts['post_file'] == '') {
                } else { ?>
                  <img src="<?php echo 'post_file/' . $posts['post_file']; ?>" class="post_file" id="postFile">
                  <?php
                }
                ?>
                <p class="post_text">
                  <?= $posts['post_text'] ?>
                </p>

                <hr color="#414141">

                <div class="postDown">
                  <div class="likeable-object" data-id="<?= $posts['post_id'] ?>">
                    <button class="like-button" id="like"><i class="fa-regular fa-heart"></i></button>
                    <button class="unlike-button" id="like" style="display:none"><i class="fa-solid fa-heart"></i></button>
                    <span class="likes-count">0</span>
                    <input type="hidden" class="username-input" placeholder="Ваше ім'я" value="<?= $_COOKIE['user'] ?>">
                  </div>
                </div>
                <details>
                  <summary class="watch_comm">
                    <font size="4">
                      <?php if ($commCount['count'] == 0) {
                        echo 'Переглянути коментарі';
                      } else
                        echo 'Переглянути коментарі (' . $commCount['count'] . ')';
                      ?>
                    </font>
                  </summary>
                  <br>
                  <div class="comm">
                    <form id="" method="post">
                      <div class="commParts">
                        <div class="commPart1">
                          <img src="ava_user/<?= $role['ava'] ?>" width="35px" height="35px" id="ava_comm">
                          <input type="text" name="comm_text" placeholder="Додайте коментар" class="pole1" id="pole_comm"
                            maxlength="500" required>
                          <input type="text" name="post_id" class="pole1" id="invisibleInput"
                            value="<?= $posts['post_id'] ?>" readonly required>
                        </div>
                        <div class="commPart2">
                          <button type="submit" name="button" class="commButtSent"><i
                              class="fa-solid fa-arrow-right"></i></button>
                        </div>
                      </div>
                    </form>
                    <br>

                    <?php
                    $postId = $posts['post_id'];
                    $selComm = mysqli_query($mysql, "SELECT * FROM `post_comm` WHERE `post_id` = '$postId' ORDER BY `id` DESC");
                    $selComm1 = mysqli_fetch_assoc($selComm);

                    foreach ($selComm as $comms) {

                      $postFrom1 = mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$comms[comm_from]'");
                      $postFrom = mysqli_fetch_assoc($postFrom1);
                      ?>

                      <div class="commBlock">
                        <img src="ava_user/<?= $postFrom['ava'] ?>" width="35px" height="35px" id="ava_comm">
                        <p class="commText"><b>
                            <?= $comms['comm_from'] ?>
                          </b>
                          <font class="commDate">
                            <?= $comms['comm_date'] ?>
                          </font><br>
                          <?= $comms['comm_text'] ?>
                        </p>
                      </div>

                      <div class="commDo">
                        <details>
                          <summary class="commAnswerHeader">Відповісти</summary>
                          <form action="" method="post">
                            <div class="commAnswerParts">
                              <div class="commAnswerPart1">
                                <img src="ava_user/<?= $role['ava'] ?>" width="35px" height="35px" id="ava_comm">
                                <input type="text" name="comm_text" placeholder="Відповідь <?= $comms['comm_from'] ?>"
                                  class="pole1" id="pole_comm" maxlength="500" required>
                              </div>
                              <div class="commAnswerPart2">
                                <button type="submit" name="button" class="commButtSent"><i
                                    class="fa-solid fa-arrow-right"></i></button>
                              </div>
                            </div>
                          </form>
                        </details>

                        <details>
                          <summary class="commAnswer">—— Переглянути відповіді (1)</summary><br>
                          <img src="ava_user/<?= $postFrom['ava'] ?>" width="35px" height="35px" id="ava_comm">
                          <p class="commText commTextAnswer"><b>
                              <?= $comms['comm_from'] ?>
                            </b>
                            <font class="commDate">
                              <?= $comms['comm_date'] ?>
                            </font><br>
                            <?= $comms['comm_text'] ?>
                          </p>
                          <details>
                            <summary class="commAnswerHeader commAnswerHeader2">Відповісти</summary>
                            <form action="" method="post">
                              <div class="commAnswerParts">
                                <div class="commAnswerPart1">
                                  <img src="ava_user/<?= $role['ava'] ?>" width="35px" height="35px" id="ava_comm">
                                  <input type="text" name="comm_text" placeholder="Відповідь <?= $comms['comm_from'] ?>"
                                    class="pole1" id="pole_comm" maxlength="500" required>
                                </div>
                                <div class="commAnswerPart2">
                                  <button type="submit" name="button" class="commButtSent"><i
                                      class="fa-solid fa-arrow-right"></i></button>
                                </div>
                              </div>
                            </form>
                          </details>
                        </details>

                      </div><br>

                      <!-- <div class="windBack" id="commDel-<?= $comms['id'] ?>"> Удаление комментария
               <div class="wind" id="windDel">
                 <a href="" class="xmark"><i class="fa-solid fa-xmark"></i></a>
                 <a href="" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
                 <font color="white" class="windHeader"><p align="center">Видалити коментар?</p></font>
                 <form action="delComm.php" method="post">
                   <input type="text" name="comm_id" class="pole1" id="invisibleInput" value="<?= $comms['id'] ?>" readonly required>
                   <button type="submit" class="OK" id="okDel">Так</button>
                 </form>
               </div>
             </div> -->

                    <?php } ?>
                  </div>
                </details>
              </div>
            </div>

            <div class="windBack" id="postEdit-<?= $posts['post_id'] ?>"> <!--Изменение поста-->
              <div class="wind">
                <a href="" class="xmarkPhone"><i class="fa-solid fa-arrow-left"></i></a>
                <a href="" class="xmark"><i class="fa-solid fa-xmark"></i></a>
                <div class="windHeader">Зміна публікації</div>
                <?php
                if ($posts['post_file'] != "") {
                  echo "<div><img src='post_file/" . $posts['post_file'] . "' class='post_file'></div>";
                }
                ?>
                <form action="editPost.php" method="post">
                  <textarea name="editPostText" placeholder="Введіть новий вміст" class="pole2" id="editPostPole"
                    maxlength="5000" required><?= $posts['post_text'] ?></textarea><br>
                  <input type="text" name="postId" class="pole1" id="invisibleInput" value="<?= $posts['post_id'] ?>"
                    readonly required><br>
                  <button type="submit" class="OK">Зберегти</button>
                </form>
              </div>
            </div>

            <div class="windBack" id="postDel-<?= $posts['post_id'] ?>"> <!--Удаление поста-->
              <div class="wind" id="postDo">
                <div class="windHeader" align="center">Видалити публікацію?</div>
                <form action="delPost.php" method="post">
                  <input type="text" name="post_id" class="pole1" id="invisibleInput" value="<?= $posts['post_id'] ?>"
                    readonly required>
                  <div class="buttonsDel">
                    <button type="submit" class="buttDel"><i class="fa-solid fa-check"></i> Так</button>
                    <button type="reset" onclick="self.location=''" class="buttDel last"><i class="fa-solid fa-xmark"></i>
                      Ні</button>
                  </div>
                </form>
              </div>
            </div>

            <div class="windBack" id="postLike-<?= $posts['post_id'] ?>"> <!--Лайки на посте-->
              <div class="wind" id="postDo">
                <!-- <div class="windHeader" align="center">Заголовок</div> -->
                <?php
                $selPostLike1 = mysqli_query($mysql, "SELECT * FROM `likes` WHERE `object_id` = '$posts[post_id]' ORDER BY `id` DESC");
                $selPostLike = mysqli_fetch_assoc($selPostLike1);
                if (empty($selPostLike)) {
                  echo "<p class='noLikes' align='center'>Поки що ніхто не вподобав<br><i class='fa-solid fa-heart-crack'></i></p>";
                }
                foreach ($selPostLike1 as $postLike) {
                  $selAvaUserLike1 = mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$postLike[username]'");
                  $selAvaUserLike = mysqli_fetch_assoc($selAvaUserLike1);
                  echo "<a href='players.php' class='postUserLikeBlock'><img src='ava_user/" . $selAvaUserLike['ava'] . "' id='avaPost'>";
                  echo "<p class='postUserLike'><font>" . $postLike['username'] . "</font></p></a>";
                }
                ?>
                <br>
                <hr color="#414141" class="postDoHr">
                <div class="postDoButt" onclick="self.location = '';">
                  <div class="postDoButtStyle"><i class="fa-solid fa-arrow-left"></i>
                    <font class="postDoText">Відмінити</font>
                  </div>
                </div>
              </div>
            </div>

            <div class="windBack" id="doPost-<?= $posts['post_id'] ?>"> <!--Что делать с постом-->
              <div class="wind" id="postDo">
                <div class="postDoButt" onclick="self.location = '#postLike-<?= $posts['post_id'] ?>';">
                  <div class="postDoButtStyle"><i class="fa-solid fa-heart"></i>
                    <font class="postDoText">Вподобайки</font>
                  </div>
                </div>
                <?php if ($role['role'] == 'admin' or $posts['post_from'] == $_COOKIE['user']): ?>
                  <div class="postDoButt" onclick="self.location = '#postEdit-<?= $posts['post_id'] ?>';">
                    <div class="postDoButtStyle"><i class="fa-regular fa-pen-to-square"></i>
                      <font class="postDoText">Редагувати публікацію</font>
                    </div>
                  </div>
                  <div class="postDoButt postDoButtDel" onclick="self.location = '#postDel-<?= $posts['post_id'] ?>';">
                    <div class="postDoButtStyle"><i class="fa-regular fa-trash-can"></i>
                      <font class="postDoText">Видалити публікацію</font>
                    </div>
                  </div>
                <?php endif; ?>
                <hr color="#414141" class="postDoHr">
                <div class="postDoButt" onclick="self.location = '';">
                  <div class="postDoButtStyle"><i class="fa-solid fa-arrow-left"></i>
                    <font class="postDoText">Відмінити</font>
                  </div>
                </div>
              </div>
            </div>

          <?php } ?>

        </div>

      </div>
    </div>
    </div>

    <script type="text/javascript">
      // Предпросмотр изображения
      let load = document.querySelector('#load');

      document.querySelector('#file-input').addEventListener('change', function (e) {
        let tgt = e.target || window.event.srcElement,
          files = tgt.files;

        load.innerHTML = '';

        if (files && files.length) {
          for (let i = 0; i < files.length; i++) {
            let $self = files[i],
              fr = new FileReader();
            fr.onload = function (e) {
              load.insertAdjacentHTML('beforeEnd', `<div class="load-img"><img src="${e.srcElement.result}"/></div>`);
            }
            fr.readAsDataURL(files[i]);
          };
        }
      });

      // Изменение размера textarea при вводе (новый пост)
      var textarea = document.querySelector('textarea');
      textarea.addEventListener('keyup', function () {
        if (this.scrollTop > 0) {
          this.style.height = this.scrollHeight + "px";
        }
      });

      // Изменение размера textarea при вводе (изменение поста)
      var textarea = document.querySelector("#editPostPole");
      textarea.addEventListener('keyup', function () {
        if (this.scrollTop > 0) {
          this.style.height = this.scrollHeight + "px";
        }
      });
    </script>

  </body>

  </html>
<?php } ?>