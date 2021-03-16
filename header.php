<?php
session_start();
require_once("db_connect.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>RedditBis</title>
    </head>
    <body>
    <?php
        if(!isset($_SESSION["user"])){
    ?>
        <h1><a href="/home">Welcome stranger !</a></h1>
        
        <a href="/login">Se connecter</a>
        <a href="/signup">S'inscrire</a>
    <?php
        }else{ 
    ?>
        <h1><a href="/home">Welcome <?= $_SESSION["user"]["login"] ?>!</a></h1>
        <a href="/account">Mon Compte</a>
        <a href="/signout">Déconnexion</a>
    <?php 
        } 
    ?>