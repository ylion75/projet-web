<?php
require("header.php");

if(!isset($_GET["post_id"])){
    header("Location: ".redirect("/page_not_found?error=post not found"));
    exit;
}
try{
$sql = "INSERT INTO likes (post_id, user_id) VALUES (?,?)";
$db->prepare($sql)->execute([$_GET["post_id"],$_SESSION["user"]["id"]]);
}catch(Exception $e){
}
header("Location: ".redirect("/post?post_id={$_GET["post_id"]}"));
//var_dump($success);
//if(!$success){
    
//}

