<?php

if(isset($_SESSION['user'])){
    $requser = $db->prepare("SELECT * FROM user WHERE id = ?");
}

if (isset($_POST["newemail"]) && !empty($_POST["newemail"])) {
    $data = [
        'mail' => $_POST['newemail'],
        'id' => $_SESSION["user"]["id"]
    ];
    $sql = "UPDATE user SET email=:mail WHERE id=:id";
    $sth = $db ->prepare($sql);
    $sth->execute($data);
}

if($_SERVER['REQUEST_METHOD'] !== "POST"){
    goto display;
}

if(!isset($_FILES['avatar']) || !isset($_FILES['avatar']['name'])) {
    goto display;
}

$maxSize = 2097152;
$validExtensions = array('jpg', 'jpeg', 'gif', 'png');

if($_FILES['avatar']['size'] > $maxSize) {
    $error="Votre photo de profil ne doit pas dépasser 2Mo";
    goto display;
}

$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

if(!in_array($extensionUpload, $validExtensions)) {
    $error="Votre photo de profil doit être au format jpg, jpeg, gif ou png";
    goto display;
}

$path = "members/avatars/".$_SESSION['id'].".".$extensionUpload;
$result = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);

if(!$result) {
    $error="Erreur durant l'importation de votre photo de profil";
    goto display;
}

$updateavatar = $db->prepare('UPDATE user SET avatar = :avatar WHERE id = :id');
$updateavatar->execute(array(
    'avatar' => $_SESSION['id'].".".$extensionUpload,
    'id' => $_SESSION['id']
));

display:

?>


