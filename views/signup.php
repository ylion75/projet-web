<h1>Sign up</h1>
<h2>Créer un nouveau compte</h2>
<?php if(isset($error)) echo $error ?>
<form action="<?= uri("/signup"); ?>" method="POST" enctype="multipart/form-data">
    <label for="login">Entrez votre nom d'utilisateur</label>
    <input type="text" name="login"><br><br>
    <label for="password">Choisissez un mot de passe</label>
    <input type="password" name="password"><br><br>
    <label for="email">Entrez votre adresse email</label>
    <input required type="email" name="email"><br><br>
    <label for="avatar">Ajoutez une photo</label>
    <input type="file" name="avatar"><br><br>
    <input type="submit">

</form>