<?php
session_start();
include("db_connect.php");


if(isset($_GET['postid'])){
    $db->prepare('DELETE FROM post WHERE post.id='.$_GET['postid'])->execute();
}

header("Location: index.php");

