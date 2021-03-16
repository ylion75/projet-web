<?php
require("header.php");

if(isset($_GET['postid'])){
    $sql = "SELECT f.idForum 
            FROM forum f LEFT JOIN post p ON p.forum_id=f.idForum
            WHERE p.id=?";
    $request = $db->prepare($sql);
    $request->execute(array($_GET['postid']));
    $forumId = $request->fetch();
    var_dump($forumId);
    $db->prepare("DELETE FROM post WHERE post.id=?")->execute(array($_GET['postid']));
}

header("Location: /forum?forum_id={$forumId["idForum"]}");
