<?php
session_start();

include("db_connect.php");

if(isset ($_GET['t'], $_GET['id'])){
            $gett = $_GET['t'];
            
            if($gett == 2){
            
            
            $sql = "INSERT INTO likes (post_id, user_id) VALUES (?,?)";
            $db->prepare($sql)->execute([$_GET["id"],$_SESSION["userid"]]); 
        } 

            elseif($gett == 3)
            {
                $sql = "INSERT INTO dislikes (post_id,user_id) VALUES (?,?)";
                $db->prepare($sql)->execute([$_GET["id"], $_SESSION["userid"]]); 
            } }

        

header("Location: index.php");