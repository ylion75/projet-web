<?php
include("header.php");
include("redirect.php");

if($_SERVER['REQUEST_METHOD'] !== "POST"){
    goto relocation;
}
if(!isset($_SESSION["user"])){ 
    goto relocation;
}
if(!isset($_POST["comment"])){
    goto relocation;
}
        
$sql = "INSERT INTO comment (content, author, date, parent_id) VALUES (?,?,?,?)";
$db->prepare($sql)->execute([$_POST["comment"], $_SESSION["user"]["id"], date("Y-m-d H:i:s"),$_GET["post_id"]]);  
   
relocation :
header("Location: ".redirect("//post?post_id=".$_GET["post_id"]));