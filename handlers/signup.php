<?php

if($_SERVER['REQUEST_METHOD'] !== "POST"){
goto display;
}

if(!isset($_POST["login"]) || !isset($_POST["password"])){
    $error = "Veuillez remplir tous les champs";
    goto display;
}

$request = $db->prepare("SELECT COUNT(id) FROM user WHERE login= :login");
$request->execute(["login" => $_POST["login"]]);
$existinguser = $request->fetch();

if($existinguser[0] > 0){
    $error = "Ce login existe déjà";
    goto display;
}

if(!isset($_FILES['avatar']) || !isset($_FILES['avatar']['name'])){
    goto display;
}

$maxSize = 2097152;
$validExtensions = array('jpg', 'jpeg', 'gif', 'png');

if($_FILES['avatar']['size'] > $maxSize){
    $error="Votre photo de profil ne doit pas dépasser 2Mo";
    goto display;
}

$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

if(!in_array($extensionUpload, $validExtensions)){
    $error="Votre photo de profil doit être au format jpg, jpeg, gif ou png";
    goto display;
}

$path = "members/avatars/".$_POST["login"].".".$extensionUpload;
$result = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);

if(!$result){
    $error="Erreur durant l'importation de votre photo de profil";
    goto display;
}

$updateavatar = $db->prepare('UPDATE user SET avatar = :avatar WHERE id = :id');
$updateavatar->execute(array(
    'avatar' => $_POST["login"].".".$extensionUpload,
    'id' => $_POST["login"]
));


$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
$request = $db->prepare("INSERT INTO user (login, password,email) VALUES (?,?,?)");
$request->execute([$_POST["login"], $password, $_POST["email"]]);
//rowCount pour vérifier que tout s'est bien passé
header("Location: ".uri("/home"));

display :

