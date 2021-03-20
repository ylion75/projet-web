<?php

if(isset($_GET['post_id'])){
    $request = $db->prepare("SELECT f.idForum 
                            FROM forum f 
                                LEFT JOIN post p ON p.forum_id=f.idForum
                            WHERE p.id=?");
    $request->execute(array($_GET['post_id']));
    $forumId = $request->fetch();
    
    $db->prepare("DELETE FROM post WHERE post.id=?")->execute(array($_GET['post_id']));
    
    header("Location: ".uri("/forum?forum_id={$forumId["idForum"]}"));
    exit;
}

echo "raté";
