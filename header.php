<?php
session_start();
require("db_connect.php");
?>
<!DOCTYPE html>
<html>
    <head><a href="index.php">RedditBis</a></head>
    <body>
    <?php
        if(!isset($_SESSION["user"])){
    ?>
        <title>Welcome stranger !</title>
        
        <a href="login.php">Se connecter</a>
        <a href="signup.php">S'inscrire</a>
    <?php
        }else{ 
    ?>
        <title>Welcome <?= $_SESSION["user"]["login"] ?>!</title>
        <!--<a href="account.php">Mon Compte</a>-->
        <a href="signout.php">Déconnexion</a>
    <?php 
        } 
    ?>