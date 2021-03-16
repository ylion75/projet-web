<?php
include("header.php");

if($_SERVER['REQUEST_METHOD'] !== "POST"){
    echo "erreur post";
    goto relocation;
}
if(!isset($_SESSION["user"])){ 
    echo "erreur user";
    goto relocation;
}
if(!isset($_POST["comment"])){
    echo "erreur comment";
    goto relocation;
}
        
$sql = "INSERT INTO comment (content, author, date, parent_id) VALUES (?,?,?,?)";
$db->prepare($sql)->execute([$_POST["comment"], $_SESSION["user"]["id"], date("Y-m-d H:i:s"),$_GET["post_id"]]);  
   
relocation :
header("Location: /post?post_id={$_GET["post_id"]}");