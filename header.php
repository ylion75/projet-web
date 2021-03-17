<?php
session_start();
require_once("db_connect.php");

function redirect($path){
    $base = "/projet-web-Dev";
    return $base.$path;
}
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
        <h1><a href="<?= redirect("/home"); ?>">Welcome stranger !</a></h1>
        
        <a href="<?= redirect("/login"); ?>">Se connecter</a>
        <a href="<?= redirect("/signup"); ?>">S'inscrire</a>
    <?php
        }else{ 
    ?>
        <h1><a href="<?= redirect("/home"); ?>">Welcome <?= $_SESSION["user"]["login"] ?>!</a></h1>
        <a href="<?= redirect("/account"); ?>">Mon Compte</a>
        <a href="<?= redirect("/signout"); ?>">Déconnexion</a>
    <?php 
        } 
    ?>