<?php
$sql = "SELECT f.*, c.nom, c.id as categorie_id FROM forum f LEFT JOIN categorie c ON f.categorie_id=c.id";
$forums = $db->prepare($sql)->execute();
?>

<h1>Tous les forums :<h1>
<?php 
    foreach($forums as $forum){ 
?>
<div>
    <dl>
        <dt><a href="forum?forum_id=<?= $forum["id"] ?>">Nom</a></dt><dd><?= $forum["nomForum"] ?></dd>
        <dt>Description</dt><dd><?= $forum["description"] ?></dd>
        <dt>Date de creation</dt><dd><?= $forum["dateCreation"] ?></dd>
        <dt><a href="categorie?categorie_id=<?= $forum["categorie_id"] ?>">Categorie</a></dt><dd><?= $forum["nom"] ?></dd>
    </dl>
</div>
<?php
}
?>