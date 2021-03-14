<?php
require_one("/db_connect.php");

if(!isset($_GET["forum_id"])){
    header("/error404");
    exit;
}
$forumId = $_GET["forum_id"];

$request = "SELECT f.id as forum_id, f.*, c.nom as category_name
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

<h2>Posts</h2>

<?php 
    include("/posts.php");
?>