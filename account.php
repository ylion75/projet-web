<?php
session_start();
include("db_connect.php");

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
    <p>User : <?= $_SESSION["user"]["login"] ?> (you can't change your user name)</p>
    <p>
        <label for="current_password">Your current password</label>
        <br/>
        <input type="password" name="current_password" id="current_password" />
    </p>

    <p>
        <label for="new_password">Your new password</label>
        <br/>
        <input type="password" name="new_password" id="new_password" />
    </p>
    <p>
        <label for="new_password">Confirm your password</label>
        <br/>
        <input type="password" name="new_password" id="new_password" />
    </p>

    <br><br><br><br><br><br><br><br><br><br>


    <label for="password">Password</label>
    <input type="password" name="password"><br><br>
    <label for="email">Email</label>
    <input required type="email" name="email"><br><br>
    <label for="avatar">Add or udpate my avatar</label>
    <input type="file" name="avatar"><br><br>
    <input type="submit">


</form>
</body>
</html>