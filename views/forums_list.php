<?php
    if(isset($_GET['message'])){
        echo $_GET['message'];
    }
?>
<h2>Tous les forums :</h2>
<?php 
if($forums !== null){
    foreach($forums as $forum){ 
?>
<div>
    <dl>
        <dt>Nom</dt><dd><a href="<?= uri("/forum?forum_id={$forum["idForum"]}")  ?>"><?= $forum["nomForum"] ?></a></dd>
        <dt>Description</dt><dd><?= $forum["description"] ?></dd>
        <dt>Date de creation</dt><dd><?= $forum["dateCreation"] ?></dd>
        <dt><a href="<?= uri("/categorie?categorie_id={$forum["categorie_id"]}")  ?>">Categorie</a></dt><dd><?= $forum["nom"] ?></dd>
    </dl>
</div>
<?php
    }
}
?>