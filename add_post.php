<?php

if($_SERVER['REQUEST_METHOD'] !== "POST"){
    goto relocation;
}
if(!isset($_SESSION["user"])){
    goto relocation;
}
if(!isset($_POST["title"])){
    goto relocation;
}
if(!isset($_GET["forum_id"])){
    goto relocation;
}
if(isset($_POST["post"])){
    $post = $_POST["post"];
}else{
    $post = "";
}
$sql = "INSERT INTO post (title, content, date, author, forum_id) VALUES (?,?,?,?,?)";
$db->prepare($sql)->execute(array($_POST["title"], $post, date("Y-m-d H:i:s"), $_SESSION["user"]["id"], $_GET["forum_id"]));  
relocation :
header("Location: ".uri("/forum?forum_id={$_GET["forum_id"]}"));