<?php
session_start();

include("db_connect.php");

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_SESSION["userid"])){
        if(isset($_POST["title"])){
            if(isset($_POST["post"])){
                $post = $_POST["post"];
            }
            else{
                $post = "";
            }
            //$request = $db->exec("INSERT INTO post VALUES (null, $title, $post, now(), {$_SESSION["userid"]})");
            $sql = "INSERT INTO post (title, content, date, author) VALUES (?,?,?,?)";
            $db->prepare($sql)->execute([$_POST["title"], $post, date("Y-m-d H:i:s"), $_SESSION["userid"]]);  
        }
    }

        
}

header("Location: index.php");