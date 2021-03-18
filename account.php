<?php
include("header.php");

if(isset($_SESSION['user'])){
    $requser = $db->prepare("SELECT * FROM user WHERE id = ?");
    //$requser->execute(array($_SESSION['user'])); //array to string conversion error
    $user = $requser->fetch();

    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email']) {
        $newmail = htmlspecialchars($_POST['newmail']);
        $insertmail = $db->prepare("UPDATE user SET email = ? WHERE id = ?");
        $insertmail->execute(array($newmail, $_SESSION['user']));
        header("Location: ".redirect("/home"));
    }
}
else{
    echo("erreur");
}



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




<title>Account</title>
<h1>Edit my profile</h1>
<form action="<?= redirect("/signup"); ?>" method="POST">
    <p>User : <?= $_SESSION["user"]["login"] ?> (you can't change your user name)</p>
    <p>Your current email : <?= $_SESSION["user"]["email"] ?></p>
    <label for="email">New email</label>
    <input required type="email" name="newemail" placeholder=<?= "new@email" ?>><br><br>
    <label for="email">Confirm your email</label>
    <input required type="email" name="newemail" placeholder=<?= "new@email" ?>><br><br>
    <label for="avatar">Add or udpate my avatar</label>
    <input type="file" name="avatar"><br><br>

    <input type="submit" value = "Update my profil">




    <!--
    <br><br><br><br>
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

    <br><br><br><br>
    <label for="password">Password</label>
    <input type="password" name="password"><br><br>
    <label for="email">Email</label>
    <input required type="email" name="email"><br><br>
    <label for="avatar">Add or udpate my avatar</label>
    <input type="file" name="avatar"><br><br>
    -->


</form>
<?php
    include("footer.php");
?>