<h1><a href="<?= uri("/forum?forum_id={$post["idForum"]}") ?>"><?= $post["forum_name"] ?></a></h1>
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
        <dt><?php 
                if(isset($_SESSION["user"])) { 
            ?>
            <a href="<?= uri("/likes?post_id={$post["id"]}") ?>">Like</a>
            <?php 
                }else{
            ?>
            Like
            <?php 
                } 
            ?>
        </dt>
            <dd>(<?= $likes ?>)</dd>
        <dt><?php 
                if(isset($_SESSION["user"])) { 
            ?>
            <a href="<?= uri("/dislikes?post_id={$post["id"]}") ?>">Dislike</a>
            <?php 
                }else{
            ?>
            Dislike
            <?php 
                } 
            ?></dt>
            <dd>(<?= $dislikes ?>)</dd>
<?php
    if(isset($_SESSION["user"]) && $post["author"] === $_SESSION["user"]["id"]) {
?>
        <dt><a href="<?= uri("/delete_post?post_id={$post["id"]}") ?>">Delete</a></dt>
            <dd></dd>
<?php
    }
?>
    </dl>
</div>

<?php
    if(isset($_SESSION["user"])){
?>
<form action="<?= uri("/add_comment?post_id={$post["id"]}") ?>" method="POST">
    <label for="comment">Add a comment:</label>
    <input type="text" name="comment" id="comment">
    <input type="submit">
</form>
<?php
    }
?>

<h2>List of comments</h2>
<?php
    foreach($comments as $comment) {
?>
<div>
    <dl>
        <dt>Content</dt><dd><?= $comment["content"] ?></dd>
        <dt>Author</dt><dd><?= $comment["login"] ?></dd>
        <dt>Date</dt><dd><?= $comment["date"] ?></dd>
    </dl>
</div>
<?php
    }
?>