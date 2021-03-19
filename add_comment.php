<?php
include("header.php");

<<<<<<< HEAD
if($_SERVER['REQUEST_METHOD'] !== "POST"){
    goto relocation;
=======
include("db_connect.php");


if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_SESSION["user"]["id"])){ 
        if (isset($_POST["comment"])){
            $comment = $_POST["comment"];
            
        }
        else{
            $comment = "";
        }
        
        $sql = "INSERT INTO comment (content, author, date, parent_id) VALUES (?,?,?,?)";
        $db->prepare($sql)->execute([$comment, $_SESSION["user"]["id"], date("Y-m-d H:i:s"),$_GET["post_id"]]);  
    }
    
>>>>>>> 3f361139f51503ba6abfacbb5b3a64528206fb76
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