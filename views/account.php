<h1>Account</h1>
<h2>Edit my profile</h2>
<?php if(isset($error)){ echo $error; } ?>
<form action="<?= uri("/account"); ?>" method="POST">
    <p>Votre nom d'utilisateur: <?= $_SESSION["user"]["login"] ?></p>
    <p>Votre adresse email : <?= $_SESSION["user"]["email"] ?></p>
    <label for="email">Changez mon e-mail</label>
    <input required type="email" name="newemail" placeholder="new@email">
    <label for="email">Confirmez mon email</label>
    <input required type="email" name="newemail" placeholder="new@email">
    <label for="avatar">Ajouter ou modifier ma photo</label>
    <input type="file" name="avatar">
    <input type="submit" value = "Update my profil">
</form>