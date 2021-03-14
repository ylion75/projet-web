<?php
if(!isset($_GET["forum_id"])){
    header("/error404");
    exit;
}
$forumId = $_GET["forum_id"];

$request = "SELECT f.*, c.nom as category_name
            FROM forum f LEFT JOIN categorie c ON f.categorie_id=c.id
            WHERE f.id=?";
$forum = $db->prepare($request)->execute($forumId);

if($forum === null){
    header("/error404");
    exit;
}

?>

<h1><?= $forum["nomForum"] ?></h1>
<div>
    <dl>
        <dt>Description</dt><dd><?= $forum["description"] ?></dd>
        <dt>Admin</dt><dd><?= $forum["admin"] ?></dd>
        <dt>Categorie</dt><dd><?= $forum["category_name"] ?></dd>
        <dt>Date de creation</dt><dd><?= $forum["dateCreation"] ?></dd>
    </dl>
</div>

<h2>Add a post :<h2>
<form action="add_post.php?forum_id=<?= $forum["id"] ?>" method="POST">
    <label for="title">Choose a title</label>
    <input type="text" name="title" id="title">
    <label for="post">Enter your message</label>
    <input type="text" name="post" id="post">
    <input type="submit">
</form>

<h2>Posts</h2>

<?php 
    include("/posts.php");
?>