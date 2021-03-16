<?php
require("header.php");

if($_SERVER['REQUEST_METHOD'] !== "POST"){
    echo "erreur post";
    goto relocation;
}
if(!isset($_SESSION["user"])){
    echo "erreur user";
    goto relocation;
}
if(!isset($_POST["title"])){
    echo "erreur title";
    goto relocation;
}
if(!isset($_GET["forum_id"])){
    echo "erreur forum id";
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
header("Location: /forum?forum_id={$_GET["forum_id"]}");