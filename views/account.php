<h1>Account</h1>
<h2>Edit my profile</h2>
<?php if(isset($_GET['message'])){ echo $_GET['message']; } ?>
<form action="<?= uri("/modify_account"); ?>" method="POST">
    <p>Votre nom d'utilisateur: <?= $_SESSION["user"]["login"] ?></p>
    <p>Votre adresse email : <?= $_SESSION["user"]["email"] ?></p>
    <label for="new_email">Changez mon e-mail</label>
    <input required type="email" name="new_email" placeholder="new@email">
    <label for="confirm_email">Confirmez mon email</label>
    <input required type="email" name="confirm_email" placeholder="new@email">
    <label for="avatar">Ajouter ou modifier ma photo</label>
    <input type="file" name="avatar">
    <input type="submit" value="Update my profil">
</form>