<title>Log in</title>
<p> 
<?php 
    if(isset($error)){
        echo $error;
    }
?> 
</p>
<form action="<?= uri("/login"); ?>" method="POST">
    <label for="login">Enter your login</label>
    <input type="text" name="login">
    <label for="password">Enter your password</label>
    <input type="password" name="password">
    <input type="submit">
</form>