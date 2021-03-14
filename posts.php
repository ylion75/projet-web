<?php
$sql = "SELECT p.*, u.login FROM user u LEFT JOIN post p ON u.id=p.author WHERE p.forum_id=? ORDER BY p.date";
$posts = $db->prepare($sql)->execute([$forum["forum_id"]]);

foreach($posts as $post) {
    $sql = "SELECT like_id 
            FROM likes 
            WHERE post_id=?";
    $likes = $db->prepare($sql)->execute(array($post["id"]))->rowCount();

    $sql = "SELECT dislike_id 
            FROM dislikes 
            WHERE post_id=?";
    $dislike = $db->prepare($sql)->execute(array($post["id"]))->rowCount();

    $sql = "SELECT c.*, u.login
            FROM user u
            LEFT JOIN comment c ON c.author=u.id
            LEFT JOIN post p ON p.id=c.parent_id
            WHERE p.id=?
            ORDER BY c.date, p.author";
    $comments = $db->prepare($sql)->execute([$post["id"]]);
    ?>
    <div>
        <dl>
            <dt>Title</dt>
                <dd><?= $post["title"] ?></dd>
            <dt>Content</dt>
                <dd><?= $post["content"] ?></dd>
            <dt>Author</dt>
                <dd><?= $post["login"] ?></dd>
            <dt>Date</dt>
                <dd><?= $post["date"] ?></dd>
            <dt><a href="likes_dislikes.php?t=2&id=<?= $post["id"] ?>">Like</a></dt>
                <dd>(<?= $likes ?>)</dd>
            <dt><a href="likes_dislikes.php?t=3&id=<?= $post["id"] ?>">Dislike</a></dt>
                <dd>(<?= $likes ?>)</dd>
    <?php
        if(isset($_SESSION["user"]) && $post["author"] === $_SESSION["user"]["id"]) {
    ?>
            <dt><a href="deletePost.php?postid=<?= $post["id"] ?>">Delete</a></dt>
                <dd></dd>
    <?php
        }
    ?>
        </dt>
        <form action="add_comment.php?post_id=<?= $post["id"] ?>" method="POST">
            <label for="comment">Enter your message</label>
            <input type="text" name="comment" id="comment">
            <input type="submit">
        </form>
        <h2>List of comments</h2>
    <?php
        foreach($comments as $comment) {
    ?>
        <div>
            <p> Content : <?= $comment["content"] ?></p>
            <p> Author : <?= $comment["login"] ?></p>
            <p> Date : <?= $comment["date"] ?></p>
        </div>
    <?php
        }
    }
    ?>