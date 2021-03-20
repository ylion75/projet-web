<?php

if (isset($_POST["new_email"]) && isset($_POST["confirm_email"])) {
    if($_POST["new_email"] !== $_POST["confirm_email"]){
        $error = "Les 2 mails saisis ne correspondent pas";
        header("Location: ".uri("/account?message=$error"));
        exit;
    }
    
    $sth = $db ->prepare("UPDATE user SET email=:email WHERE id=:id");
    $sth->execute([
        "email" => $_POST["new_email"],
        "id" => $_SESSION["user"]["id"],
    ]);
}

if(isset($_FILES['avatar']) && isset($_FILES['avatar']['name'])) {

    $maxSize = 2097152;
    $validExtensions = array('jpg', 'jpeg', 'gif', 'png');

    if($_FILES['avatar']['size'] > $maxSize) {
        $error="Votre photo de profil ne doit pas dépasser 2Mo";
        header("Location: ".uri("/account?message=$error"));
        exit;
    }

    $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

    if(!in_array($extensionUpload, $validExtensions)) {
        $error="Votre photo de profil doit être au format jpg, jpeg, gif ou png";
        header("Location: ".uri("/account?message=$error"));
        exit;
    }

    $path = "members/avatars/".$_SESSION['id'].".".$extensionUpload;
    $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);

    if(!$result) {
        $error="Erreur durant l'importation de votre photo de profil";
        header("Location: ".uri("/account?message=$error"));
        exit;
    }

    $updateavatar = $db->prepare('UPDATE user SET avatar = :avatar WHERE id = :id');
    $updateavatar->execute(array(
        'avatar' => $_SESSION['id'].".".$extensionUpload,
        'id' => $_SESSION['id']
    ));
}
header("Location: ".uri("/account?message=Vos informations ont bien été modifiées"));
exit;

?>

