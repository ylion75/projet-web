<?php

if(!isset($_GET["forum_id"])){
    header("Location: ".uri("/page_not_found?error=forum inconnu"));
    exit;
}

$request = $db->prepare("SELECT f.*, c.nom as category_name, u.login
                        FROM forum f 
                            LEFT JOIN categorie c ON f.categorie_id=c.id
                            LEFT JOIN user u ON f.admin=u.id
                        WHERE f.idForum=?");
$request->execute(array($_GET["forum_id"]));
$forum = $request->fetch();

if($forum === false){
    header("Location: ".uri("/page_not_found?error=forum inconnu"));
    exit;
}

;
$request = $db->prepare("SELECT p.*, u.login, u.id as user_id
                        FROM post p 
                            LEFT JOIN user u ON p.author=u.id
                        WHERE p.forum_id=?");
$request->execute(array($_GET["forum_id"]));
$posts = $request->fetchAll();

render("forum", [
    "forum" => $forum,
    "posts" => $posts,
]);

