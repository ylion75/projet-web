<?php

if(!isset($_SESSION["user"]) || !isset($_POST["title"]) || !isset($_GET["forum_id"])){
    header("Location: ".uri("/page_not_found?error=Impossible d'ajouter un post"));
    exit;
}

if(isset($_POST["post"])){
    $post = $_POST["post"];
}else{
    $post = "";
}

$db->prepare("INSERT INTO post (title, content, date, author, forum_id) VALUES (?,?,?,?,?)")
        ->execute(array($_POST["title"], $post, date("Y-m-d H:i:s"), $_SESSION["user"]["id"], $_GET["forum_id"]));  

header("Location: ".uri("/forum?forum_id={$_GET["forum_id"]}"));
exit;
