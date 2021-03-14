<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_SESSION["userid"])){ 
        if (isset($_POST["comment"])){
            $comment = $_POST["comment"];
            
        }
        else{
            $comment = "";
        }
        
        $sql = "INSERT INTO comment (content, author, date, parent_id) VALUES (?,?,?,?)";
        $db->prepare($sql)->execute([$comment, $_SESSION["userid"], date("Y-m-d H:i:s"),$_GET["post_id"]]);  
    }
    
}

header("Location: index.php");