<?php

if(!isset($_GET["post_id"])){
    header("Location: ".redirect("/page_not_found?error=post inconnu"));
    exit;
}

$request = $db->prepare("SELECT p.*, u.login, f.nomForum as forum_name, f.idForum
                        FROM post p 
                                LEFT JOIN user u ON p.author=u.id
                                LEFT JOIN forum f ON p.forum_id=f.idForum
                        WHERE p.id=?");
$request->execute(array($_GET["post_id"]));
$post = $request->fetch();

if($post === false){
    header("Location: ".uri("/page_not_found?error=post inconnu"));
    exit;
}

$likes = $db->prepare("SELECT post_id FROM likes WHERE post_id=? ");
$likes->execute(array($post["id"]));
$likes =  $likes->rowCount();

$dislikes = $db->prepare("SELECT post_id FROM dislikes WHERE post_id=?");
$dislikes->execute(array($post["id"]));
$dislikes =  $dislikes->rowCount();

$request = $db->prepare("SELECT c.*, u.login
                        FROM user u
                            LEFT JOIN comment c ON c.author=u.id
                            LEFT JOIN post p ON p.id=c.parent_id
                        WHERE p.id=?
                        ORDER BY c.date, p.author");
$request->execute(array($post["id"]));
$comments = $request->fetchAll();

render("post", [
        "post" => $post,
        "likes" => $likes,
        "dislikes" => $dislikes,
        "comments" => $comments,
]);