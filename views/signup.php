<h1>Sign up</h1>
<h2>Créer un nouveau compte</h2>
<?php if(isset($_GET['message'])) echo $_GET['message'] ?>
<form action="<?= uri("/create_account"); ?>" method="POST" enctype="multipart/form-data">
    <label for="login">Entrez votre nom d'utilisateur</label>
    <input type="text" name="login">
    <label for="password">Choisissez un mot de passe</label>
    <input type="password" name="password">
    <label for="email">Entrez votre adresse email</label>
    <input required type="email" name="email">
    <label for="avatar">Ajoutez une photo</label>
    <input type="file" name="avatar">
    <input type="submit">

</form>