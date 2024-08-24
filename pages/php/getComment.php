<?php
include ("../../connect.php");
// Отримати коментарі та відповіді з бази даних
$sql = "SELECT * FROM `post_comment` ORDER BY `id` DESC";
$result = mysqli_query($mysql, $sql);

$comments = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }
}

// Функція для відображення коментарів та їх відповідей
function displayComments($comments, $mysql, $parentId = 0)
{
    foreach ($comments as $comment) {
        if ($comment['parent_id'] == $parentId):
            $commentFrom = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `user` WHERE `login` = '$comment[username]'"));
            ?>
            <div class="comment">
                <div class="userInfo" onclick="self.location = 'page.php?login=<?= $comment['username'] ?>'">
                    <img src="ava_user/<?= $commentFrom['ava'] ?>" class="userAva userAvaComment">
                    <div>
                        <p class="userName userNameComment"><?= $comment['username'] ?></p>
                        <p class="postTime"><?= $comment['date'] ?></p>
                    </div>
                </div>
                <p class="postText commentText"><?= $comment['comment'] ?></p>
                <details>
                    <summary class="commentHeader commentAnswerHeader" id="replyButton-<?= $comment['id'] ?>" data-id="<?= $comment['id'] ?>">Відповісти</summary>
                    <div class="newComment newAnswer">
                        <img src="ava_user/<?= $commentFrom['ava'] ?>" class="userAva userAvaComment">
                        <textarea name="commentText" id="commentText" placeholder="Відповідь <?= $_COOKIE['user'] ?>" class="pole1"
                            rows="1" required></textarea>
                        <button type="submit" class="newPostButt"><i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </details>
                <details class="answerContainer">
                    <summary class="commentHeader answerHeader">⎯⎯⎯ Переглянути відповіді (1)
                    </summary>
                    <div class="userInfo" onclick="self.location = 'page.php?login=<?= $_COOKIE['user'] ?>'">
                        <img src="ava_user/<?= $commentFrom['ava'] ?>" class="userAva userAvaComment">
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
                            <img src="ava_user/<?= $commentFrom['ava'] ?>" class="userAva userAvaComment">
                            <textarea name="commentText" id="commentText" placeholder="Відповідь <?= $_COOKIE['user'] ?>"
                                class="pole1" rows="1" required></textarea>
                            <button type="submit" class="newPostButt"><i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </details>
                </details>
            </div>
            <?php
            displayComments($comments, $mysql, $comment['id']); // Рекурсивно вивести відповіді на цей коментар
            // echo "<li>";
            // echo "<strong>" . htmlspecialchars($comment['name']) . "</strong>: " . htmlspecialchars($comment['comment']);
            // echo "<button class='replyButton' data-id='" . $comment['id'] . "'>Відповісти</button>";
            // echo "</li>";
        endif;
    }
}

// Вивести коментарі та відповіді
displayComments($comments, $mysql);

mysqli_close($mysql);
?>