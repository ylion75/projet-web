<?php

if(!isset($_GET["post_id"])){
    header("Location: ".redirect("/page_not_found?error=post not found"));
    exit;
}
try{
    $db->prepare("INSERT INTO dislikes (post_id, user_id) VALUES (?,?)")
        ->execute([$_GET["post_id"],$_SESSION["user"]["id"]]);
}catch(Exception $e){
}

header("Location: ".uri("/post?post_id={$_GET["post_id"]}"));
exit;