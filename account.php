<?php
include("header.php");

//partie à vérifier
if(isset($_SESSION['user'])){
    $requser = $db->prepare("SELECT * FROM user WHERE id = ?");
}

if(isset($_POST["newemail"]) AND isset($_POST["confirmmail"])){
    $insertmail = $db->prepare("UPDATE user SET email = '{$_POST["newemail"]}'");
    $insertmail->execute(array($_POST["newemail"], $_SESSION['user']['id']));
}
//fin de partie à vérifier



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




<h1>Account</h1>
<h2>Edit my profile</h2>
<?php if(isset($error)){ echo $error; } ?>
<form action="<?= redirect("/account"); ?>" method="POST">
    <p>Votre nom d'utilisateur: <?= $_SESSION["user"]["login"] ?> (vous ne pouvez pas le changer)</p>
    <p>Votre adresse email : <?= $_SESSION["user"]["email"] ?></p>
    <label for="email">Changez mon e-mail</label>
    <input required type="email" name="newemail" placeholder=<?= "new@email" ?>>
    <label for="email">Confirmez mon email</label>
    <input required type="email" name="newemail" placeholder=<?= "new@email" ?>>
    <label for="avatar">Ajouter ou modifier ma photo</label>
    <input type="file" name="avatar">

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