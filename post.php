<?php
require("header.php");

if(!isset($_GET["post_id"])){
    header("Location: ".redirect("/page_not_found?error=post inconnu"));
    exit;
}

$sql = "SELECT p.*, u.login, f.nomForum as forum_name, f.idForum
            FROM post p LEFT JOIN user u ON p.author=u.id
                        LEFT JOIN forum f ON p.forum_id=f.idForum
            WHERE p.id=?";
$request = $db->prepare($sql);
$request->execute(array($_GET["post_id"]));
$post = $request->fetch();

if($post === false){
    header("Location: ".redirect("/page_not_found?error=post inconnu"));
    exit;
}

$sql = "SELECT like_id 
        FROM likes 
        WHERE post_id=?";
$likes = $db->prepare("SELECT like_id FROM likes WHERE post_id= ? ");
$likes->execute(array($post["id"]));
$likes =  $likes->rowCount();

$sql = "SELECT dislike_id 
        FROM dislikes 
        WHERE post_id=?";
$dislikes = $db->prepare("SELECT dislike_id FROM dislikes WHERE post_id= ?");
$dislikes->execute(array($post["id"]));
$dislikes =  $dislikes->rowCount();

$sql = "SELECT c.*, u.login
        FROM user u
        LEFT JOIN comment c ON c.author=u.id
        LEFT JOIN post p ON p.id=c.parent_id
        WHERE p.id=?
        ORDER BY c.date, p.author";
$comments = $db->query("SELECT c.*, u.login
                        FROM user u
                        LEFT JOIN comment c ON c.author = u.id
                        LEFT JOIN post p ON p.id = c.parent_id
                        WHERE p.id = {$post["id"]}
                        ORDER BY c.date, p.author")->fetchAll();
?>
<h1><a href="<?= redirect("/forum?forum_id={$post["idForum"]}") ?>"><?= $post["forum_name"] ?></a></h1>
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
            <a href="<?= redirect("/likes_dislikes?t=2&id={$post["id"]}") ?>">Like</a>
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
            <a href="<?= redirect("/likes_dislikes?t=3&id={$post["id"]}") ?>">Dislike</a>
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
        <dt><a href="<?= redirect("/delete_post?postid={$post["id"]}") ?>">Delete</a></dt>
            <dd></dd>
<?php
    }
?>
    </dl>
</div>

<?php
    if(isset($_SESSION["user"])){
?>
<form action="<?= redirect("/add_comment?post_id={$post["id"]}") ?>" method="POST">
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

    require("footer.php");
?>