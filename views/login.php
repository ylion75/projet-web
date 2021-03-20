<h1>Log in</h1>
<p> 
<?php 
    if(isset($_GET['error'])){
        echo $_GET['error'];
    }
?> 
</p>
<form action="<?= uri("/verify_user"); ?>" method="POST">
    <label for="login">Enter your login</label>
    <input type="text" name="login">
    <label for="password">Enter your password</label>
    <input type="password" name="password">
    <input type="submit">
</form>