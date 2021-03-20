<?php

if(!isset($_POST["login"]) || !isset($_POST["password"])){
    $error = "Veuillez remplir tous les champs";
    header("Location: ".uri("/login?error=$error"));
    exit;
}

$request = $db->prepare("SELECT * FROM user WHERE login=?");
$request->execute([$_POST["login"]]);
$user = $request->fetch();

if($user === null){
    $error = "Login ou mot de passe invalide";
    header("Location: ".uri("/login?error=$error"));
    exit;
}

$ok = password_verify($_POST["password"], $user["password"]);

if(!$ok){
    $error = "Login ou mot de passe invalide";
    header("Location: ".uri("/login?error=$error"));
    exit;
}

$_SESSION["user"] = $user;
header("Location: ".uri("/home"));
exit;

?>

