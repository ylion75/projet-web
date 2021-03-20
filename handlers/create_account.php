<?php
if(!isset($_POST["login"]) || !isset($_POST["password"])){
    $error = "Veuillez remplir tous les champs";
    header("Location: /signup?message=$error");
}

$request = $db->prepare("SELECT id FROM user WHERE login=?");
$request->execute([$_POST["login"]]);
$existinguser = $request->rowCount();

if($existinguser > 0){
    $error = "Ce login existe déjà";
    header("Location: ".uri("/signup?message=$error"));
    exit;
}

$maxSize = 2097152;
$validExtensions = array('jpg', 'jpeg', 'gif', 'png');

if(!isset($_FILES['avatar']) || !isset($_FILES['avatar']['name']) || !isset($_POST['avatar'])){
    $avatar = "NULL";
}else{
    if($_FILES['avatar']['size'] > $maxSize){
        $error="Votre photo de profil ne doit pas dépasser 2Mo";
        header("Location: ".uri("/signup?message=$error"));
        exit;
    }

    $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

    if(!in_array($extensionUpload, $validExtensions)){
        $error="Votre photo de profil doit être au format jpg, jpeg, gif ou png";
        header("Location: ".uri("/signup?message=$error"));
        exit;
    }

    $avatar = $_POST["login"].".".$extensionUpload;
    
    $result = move_uploaded_file($_FILES['avatar']['tmp_name'], "members/avatars/$avatar");

    if(!$result){
        $error="Erreur durant l'importation de votre photo de profil";
        header("Location: ".uri("/signup?message=$error"));
        exit;
    }
}

$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
$request = $db->prepare("INSERT INTO user (login, password, email, avatar) VALUES (?,?,?, ?)");
$request->execute([$_POST["login"], $password, $_POST["email"], $avatar]);

if($request->rowCount() < 1){
    $error="Une erreur s'est produite, votre compte n'a pas pu être créé. Réessayez";
    header("Location: ".uri("/signup?message=$error"));
    exit;
}

header("Location: ".uri("/home?message=Votre compte a bien été créé. Vous pouvez dès à présent vous connecter"));
exit;