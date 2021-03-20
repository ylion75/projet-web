<?php

if(!isset($_SESSION["user"]) || !isset($_POST["comment"])){ 
    header("Location: ".uri("/page_not_found?error=Impossible d'ajouter un commentaire"));
}
    
$db->prepare("INSERT INTO comment (content, author, date, parent_id) VALUES (?,?,?,?)")->execute([$_POST["comment"], $_SESSION["user"]["id"], date("Y-m-d H:i:s"),$_GET["post_id"]]);  

header("Location: ".uri("/post?post_id=".$_GET["post_id"]));
exit;