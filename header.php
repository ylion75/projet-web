<!DOCTYPE html>
<html>
    <head>RedditBis</head>
    <body>
    <?php
        if(!isset($_SESSION["user"])){
    ?>
        <title>Welcome stranger !</title>
        
        <a href="/login.php">Se connecter</a>
    <?php
        }else{ 
    ?>
        <title>Welcome <?= $_SESSION["user"]["login"] ?>!</title>
        <a href="/signout.php">Déconnexion</a>
    <?php 
        } 
    ?>