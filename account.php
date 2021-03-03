<?php

$id = "login";
if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
    $maxSize = 2097152;
    $validExtensions = array('jpg', 'jpeg', 'gif', 'png');
    if($_FILES['avatar']['size'] <= $maxSize) {
        $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
        if(in_array($extensionUpload, $validExtensions)) {
            $path = "members/avatars/".$_SESSION['id'].".".$extensionUpload;
            $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
            if($result) {
                $updateavatar = $db->prepare('UPDATE user SET avatar = :avatar WHERE id = :id');
                $updateavatar->execute(array(
                    'avatar' => $_SESSION['id'].".".$extensionUpload,
                    'id' => $_SESSION['id']
                ));
                header('Location: profil.php?id='.$_SESSION['id']);
            } else {
                $msg = "Erreur durant l'importation de votre photo de profil";
            }
        } else {
            $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
        }
    } else {
        $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
    }
}
?>

<!DOCTYPE html>
<html>
<head>RedditBis</head>
<body>
<title>Account</title>
<h1>Edit my profile</h1>
<form action="signup.php" method="POST">
    <label for="login">Login name</label>
    <input type="text" name="login">
    <label for="password">Password</label>
    <input type="password" name="password">
    <label for="email">Email</label>
    <input required type="email" name="email">
    <input type="submit">
    <label for="avatar">Add an avatar</label>
    <input type="file" name="avatar"><br><br>

</form>
</body>
</html>