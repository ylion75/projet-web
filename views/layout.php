<!DOCTYPE html>
<html>
    <head>
        <title>RedditBis</title>
    </head>
    <body>
    <?php
        if(!isset($_SESSION["user"])){
    ?>
        <h1><a href="<?= uri("/home"); ?>">Welcome stranger !</a></h1>
        
        <a href="<?= uri("/login"); ?>">Se connecter</a>
        <a href="<?= uri("/signup"); ?>">S'inscrire</a>
    <?php
        }else{ 
    ?>
        <h1><a href="<?= uri("/home"); ?>">Welcome <?= $_SESSION["user"]["login"] ?>!</a></h1>
        <a href="<?= uri("/account"); ?>">Mon Compte</a>
        <a href="<?= uri("/signout"); ?>">Déconnexion</a>
    <?php 
        } 

    echo $content;
    ?>
    </body>
</html>