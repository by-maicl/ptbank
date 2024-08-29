<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include "../connect.php";
include "menu.php";

function newCommentForm($userInfo, $postId)
{
    echo '
    <form id="commForm-' . $postId . '">
        <div class="newComment">
            <img src="ava_user/' . $userInfo['ava'] . '" class="userAva userAvaComment">
            <textarea name="commentText" placeholder="Напишіть коментар" class="pole1" id="commentText" rows="1" required></textarea>
            <input type="hidden" name="username" id="username" value="' . $_COOKIE['user'] . '">
            <input type="hidden" name="postId" id="postId" value="' . $postId . '">
            <button type="submit" class="newPostButt"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </form>';
}

if ($_COOKIE['user'] == ''):
    echo "<script>self.location='/index.php';</script>";
else: ?>
    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <link rel="stylesheet" href="/CSS/content.css">
        <title>Головна</title>
        <script src="../js/content.js"></script>
        <script src="../js/likes.js"></script>
    </head>

    <body bgcolor="#191a19">

        <div class="content">

            <div class="advertising">
                <div class="slideshow-container">
                    <div class="slides fade">
                        <img src="advertising/1.png" style="width:100%">
                    </div>
                    <div class="slides fade">
                        <img src="advertising/2.png" style="width:100%">
                    </div>
                    <div class="slides fade">
                        <img src="advertising/3.png" style="width:100%">
                    </div>
                    <div class="slides fade">
                        <img src="advertising/4.png" style="width:100%">
                    </div>
                    <div class="slides fade">
                        <img src="advertising/5.png" style="width:100%">
                    </div>

                    <div class="dots">
                        <span class="dot" onclick="currentSlide(1)"></span>
                        <span class="dot" onclick="currentSlide(2)"></span>
                        <span class="dot" onclick="currentSlide(3)"></span>
                        <span class="dot" onclick="currentSlide(4)"></span>
                        <span class="dot" onclick="currentSlide(5)"></span>
                    </div>
                </div>
            </div>

            <?php
            $postInfo = mysqli_query($mysql, "SELECT * FROM `post` ORDER BY `post_id` DESC");
            $postInfoMore = mysqli_fetch_assoc($postInfo);
            ?>

            <div class="parts">
                <div class="contentPart" id="postContainer">

                    <form action="php/newPost.php" method="post" enctype="multipart/form-data">
                        <div class="newPostBackground">
                            <div class="post newPost">
                                <img src="ava_user/<?= $role['ava'] ?>" class="userAva">
                                <textarea name="postText" id="postText" placeholder="Що нового, <?= $_COOKIE['user'] ?>?"
                                    class="pole2 newPostPole" rows="1" required></textarea>
                                <input id="postFile" type="file" name="postFile" accept="image/*" style="display:none;">
                                <label for="postFile">
                                    <p class="newPostButt"><i class="fa-solid fa-image"></i></p>
                                </label>
                                <button type="submit" class="newPostButt" id="send"><i
                                        class="fa-solid fa-arrow-right"></i></button>
                            </div>
                            <div id="imagePreviewContainer" class="imagePreviewContainer"></div>
                        </div>
                    </form>

                    <?php
                    foreach ($postInfo as $post):
                        $postFromInfo = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$post[post_from]'"));
                        ?>

                        <div class="post" id="<?= $post['post_id'] ?>">
                            <div class="userInfo" onclick="self.location = 'page.php?login=<?= $post['post_from'] ?>'">
                                <img src="ava_user/<?= $postFromInfo['ava'] ?>" class="userAva">
                                <div class="postInfo">
                                    <p class="userName"><?= $post['post_from'] ?></p>
                                    <p class="postTime"><?= $post['post_date'] ?></p>
                                </div>
                            </div>
                            <?php if ($role['role'] == 'admin' && isset($post['post_complaint']) || $role['role'] == 'moder' && isset($post['post_complaint'])): ?>
                                <div class="postMoreInfo postComplaint" title="Скарги на публікацію">
                                    <i class="fa-solid fa-circle-exclamation"></i> <?= $post['post_complaint'] ?>
                                </div>
                            <?php endif; ?>

                            <i class="fa-solid fa-ellipsis postMoreInfo"
                                onclick="self.location = '#p-<?= $post['post_id'] ?>'"></i>

                            <?php
                            if ($post['post_file']): ?>
                                <img src="post_file/<?= $post['post_file'] ?>" class="postFile">
                            <?php endif; ?>

                            <p class="postText"><?= $post['post_text'] ?></p>
                            <hr color="#414141" class="postHr">
                            <div class="postIcons">
                                <div class="likeable-object" data-id="<?= $post['post_id'] ?>">
                                    <button class="like-button" id="like"><i class="fa-regular fa-heart"></i></button>
                                    <button class="unlike-button" id="like" style="display:none"><i
                                            class="fa-solid fa-heart"></i></button>
                                    <span class="likes-count">0</span>
                                    <input type="hidden" class="username-input" readonly value="<?= $_COOKIE['user'] ?>">
                                </div>
                                <i class="fa-regular fa-copy"
                                    onclick="copyToClipboard('<?= $_SERVER['SERVER_NAME'] . '/pages/content.php#' . $post['post_id'] ?>')"></i>
                            </div>
                            <details class="commentContainer">
                                <summary class="commentHeader">Переглянути коментарі (2)</summary>
                                <?php
                                newCommentForm($role, $post['post_id']);
                                $getComment = mysqli_query($mysql, "SELECT * FROM `post_comment` WHERE `post_id` = '$post[post_id]'");
                                foreach ($getComment as $comment):
                                    $commFromInfo = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$comment[username]'"));
                                    ?>
                                    <div id="commentContainer">
                                        <div class="comment">
                                            <div class="userInfo"
                                                onclick="self.location = 'page.php?login=<?= $commFromInfo['login'] ?>'">
                                                <img src="ava_user/<?= $commFromInfo['ava'] ?>" class="userAva userAvaComment">
                                                <div>
                                                    <p class="userName userNameComment"><?= $comment['username'] ?></p>
                                                    <p class="postTime"><?= $comment['date'] ?></p>
                                                </div>
                                            </div>
                                            <p class="postText commentText"><?= $comment['comment'] ?></p>
                                            <!-- <details>
                                            <summary class="commentHeader commentAnswerHeader">Відповісти</summary>
                                            <div class="newComment newAnswer">
                                                <img src="ava_user/<?= $role['ava'] ?>" class="userAva userAvaComment">
                                                <textarea name="commentText" id="commentText"
                                                    placeholder="Відповідь <?= $_COOKIE['user'] ?>" class="pole1" rows="1"
                                                    required></textarea>
                                                <button type="submit" class="newPostButt"><i
                                                        class="fa-solid fa-arrow-right"></i></button>
                                            </div>
                                        </details>
                                        <details class="answerContainer">
                                            <summary class="commentHeader answerHeader">⎯⎯⎯ Переглянути відповіді (1)
                                            </summary>
                                            <div class="userInfo"
                                                onclick="self.location = 'page.php?login=<?= $_COOKIE['user'] ?>'">
                                                <img src="ava_user/<?= $role['ava'] ?>" class="userAva userAvaComment">
                                                <div>
                                                    <p class="userName userNameComment">Maicl_Grab</p>
                                                    <p class="postTime">12:23 27.07.2024</p>
                                                </div>
                                            </div>
                                            <p class="postText commentText">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit.
                                                Cras quis est quis eros
                                                feugiat elementum. Mauris sit amet consectetur elit. Etiam nulla leo, luctus id
                                                fringilla quis,
                                                sagittis eget justo. Aenean imperdiet maximus purus ac eleifend. Aenean et diam
                                                mollis
                                                libero
                                                interdum scelerisque nec non nisi. Donec dignissim elementum gravida. Sed vitae
                                                malesuada
                                            </p>
                                            <details>
                                                <summary class="commentHeader commentAnswerHeader">Відповісти</summary>
                                                <div class="newComment">
                                                    <img src="ava_user/<?= $role['ava'] ?>" class="userAva userAvaComment">
                                                    <textarea name="commentText" id="commentText"
                                                        placeholder="Відповідь <?= $_COOKIE['user'] ?>" class="pole1" rows="1"
                                                        required></textarea>
                                                    <button type="submit" class="newPostButt"><i
                                                            class="fa-solid fa-arrow-right"></i></button>
                                                </div>
                                            </details>
                                        </details> -->
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </details>
                        </div>


                        <div class="windBack" id="p-<?= $post['post_id'] ?>"> <!-- Дії над публікацією -->
                            <div class="wind smallerWind">
                                <div class="wind-mobile">
                                    <div class="close-wind-line" onclick="self.location = '#'"></div>
                                    <button class="button-grey1 postInfoButt"
                                        onclick="self.location = '#p-like-<?= $post['post_id'] ?>'"><i
                                            class="fa-solid fa-heart"></i>
                                        Вподобайки</button>
                                    <?php if ($role['role'] == 'admin' || $role['role'] == 'moder' || $post['post_from'] == $_COOKIE['user']): ?>
                                        <button class="button-grey1 postInfoButt"
                                            onclick="self.location = '#p-edit-<?= $post['post_id'] ?>'"><i
                                                class="fa-solid fa-pen-to-square"></i>
                                            Змінити</button>
                                        <button class="button-grey1 postInfoButt"
                                            onclick="self.location = '#p-del-<?= $post['post_id'] ?>'"><i
                                                class="fa-solid fa-trash-can"></i>
                                            Видалити</button>
                                    <?php endif; ?>
                                    <button class="button-grey1 postInfoButt"
                                        onclick="self.location = '#p-complaint-<?= $post['post_id'] ?>'"><i
                                            class="fa-solid fa-circle-exclamation"></i>
                                        Поскаржитись</button>
                                    <hr color="#414141" class="postInfoHr">
                                    <button class="button-grey1 postInfoButt postButtBack"
                                        onclick="self.location = '#<?= $post['post_id'] ?>'"><i
                                            class="fa-solid fa-arrow-left"></i>
                                        Назад</button>
                                </div>
                            </div>
                        </div>

                        <div class="windBack" id="p-like-<?= $post['post_id'] ?>"> <!-- Вподобайки -->
                            <div class="wind smallerWind">
                                <div class="wind-mobile">
                                    <div class="close-wind-line" onclick="self.location = '#'"></div>
                                    <?php
                                    $postLikes = mysqli_query($mysql, "SELECT * FROM `likes` WHERE `object_id` = '$post[post_id]'");
                                    foreach ($postLikes as $postLikesVar):
                                        $userLikeInfo = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$postLikesVar[username]'"));
                                        ?>
                                        <button class="button-grey1 postInfoButt postInfoLikeUser"
                                            onclick="self.location = 'page.php?login=<?= $postLikesVar['username'] ?>'">
                                            <img src="ava_user/<?= $userLikeInfo['ava'] ?>"
                                                class="userAva userAvaComment"><?= $postLikesVar['username'] ?>
                                        </button>
                                        <?php
                                    endforeach;
                                    ?>
                                    <hr color="#414141" class="postInfoHr">
                                    <button class="button-grey1 postInfoButt postButtBack"
                                        onclick="self.location = '#p-<?= $post['post_id'] ?>'"><i
                                            class="fa-solid fa-arrow-left"></i>
                                        Назад</button>
                                </div>
                            </div>
                        </div>

                        <div class="windBack" id="p-edit-<?= $post['post_id'] ?>"> <!--Зміна публікації-->
                            <div class="wind windPostEdit">
                                <a href="#p-<?= $post['post_id'] ?>" class="xmarkPhone"><i
                                        class="fa-solid fa-arrow-left"></i></a>
                                <a href="#p-<?= $post['post_id'] ?>" class="xmark"><i class="fa-solid fa-xmark"></i></a>
                                <div class="windHeader">Зміна публікації</div>
                                <?php if ($post['post_file']): ?>
                                    <img src="post_file/<?= $post['post_file'] ?>" class="imagePreview postEditFile">
                                <?php endif; ?>
                                <form action="php/editPost.php" method="post">
                                    <textarea name="editPostText" placeholder="Введіть новий вміст" class="pole4"
                                        maxlength="5000" required><?= $post['post_text'] ?></textarea>
                                    <input type="hidden" name="postId" value="<?= $post['post_id'] ?>" readonly required>
                                    <button type="submit" class="OK">Зберегти</button>
                                </form>
                            </div>
                        </div>

                        <div class="windBack" id="p-del-<?= $post['post_id'] ?>"> <!-- Видалення публікації -->
                            <div class="wind smallerWind">
                                <div class="wind-mobile">
                                    <div class="close-wind-line" onclick="self.location = '#'"></div>
                                    <h2 class="wind-header small-wind-header">Видалити публікацію?</h2>
                                    <form action="php/delPost.php" method="post">
                                        <div class="buttons-confirm">
                                            <input type="hidden" name="postId" value="<?= $post['post_id'] ?>" required
                                                readonly>
                                            <button type="submit" class="button-grey2 OK"><i class="fa-solid fa-check"></i>
                                                Так</button>
                                            <button type="reset" class="button-grey2 OK" onclick="self.location = '#'"><i
                                                    class="fa-solid fa-xmark"></i> Ні</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                        <div class="windBack" id="p-complaint-<?= $post['post_id'] ?>"> <!-- Скарга на публікацію -->
                            <div class="wind smallerWind">
                                <div class="wind-mobile">
                                    <div class="close-wind-line" onclick="self.location = '#'"></div>
                                    <h2 class="wind-header small-wind-header">Поскаржитись на публікацію?</h2>
                                    <p class="complaintInfo">Адміністрація побачить вашу скаргу й прийме міри</p>
                                    <form action="php/complaint.php" method="post">
                                        <div class="buttons-confirm">
                                            <input type="hidden" name="postId" value="<?= $post['post_id'] ?>" required
                                                readonly>
                                            <button type="submit" class="button-grey2 OK"><i class="fa-solid fa-check"></i>
                                                Так</button>
                                            <button type="reset" class="button-grey2 OK" onclick="self.location = '#'"><i
                                                    class="fa-solid fa-xmark"></i> Ні</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php
                    endforeach;
                    ?>
                </div>

                <div class="supportPart">
                    <div class="supportWind">
                        <p class="supportText">Виникли якісь проблеми?</p>
                        <a href="https://discord.com/channels/957640005650620416/1091764023546089512" target="_blank">
                            <button class="button-green supportButt">Зв'язок з адміністрацією</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Попередній перегляд зображення
            document.getElementById('postFile').addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('imagePreview');

                        const previewContainer = document.getElementById('imagePreviewContainer');
                        previewContainer.innerHTML = '';
                        previewContainer.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Розширення поля вводу при створенні нової публікації
            const postText = document.getElementById('postText');

            postText.addEventListener('input', function () {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });

            postText.addEventListener('keydown', function (event) {
                if (event.key === 'Enter' && !event.shiftKey) {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                }
            });

            // Слайдер
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

            // Копіювання в буфер обміну
            function copyToClipboard(content) {
                var textarea = document.createElement("textarea");
                textarea.value = content;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);

                showPopUp("<i class='fa-solid fa-copy'></i> Скопійовано до буферу обміну")
            }

            //Коментарі
            document.addEventListener('submit', function (event) {
                if (event.target && event.target.matches('form[id^="commForm-"]')) {
                    event.preventDefault(); // Запобігає перезавантаженню сторінки

                    let username = document.getElementById('username').value;
                    let comment = document.getElementById('commentText').value;
                    let postId = document.getElementById('postId').value;

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '../pages/php/newComment.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Обробка відповіді від сервера
                            let response = JSON.parse(xhr.responseText);
                            if (response.status === "success") {
                                // Можливо, вам потрібно оновити коментарі без перезавантаження
                                // або додати коментар у відповідний контейнер
                                console.log(response.message);
                            } else {
                                console.error("Помилка під час додавання коментаря");
                            }
                        }
                    };

                    // Відправка даних на сервер
                    xhr.send('username=' + encodeURIComponent(username) + '&comment=' + encodeURIComponent(comment) + '&postId=' + encodeURIComponent(postId));
                }
            });

        </script>

    </body>

    </html>
<?php endif; ?>