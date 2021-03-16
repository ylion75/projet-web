<?php
include("header.php");

if($_SERVER['REQUEST_METHOD'] !== "POST"){
    goto display;
}

if(!isset($_POST["login"]) || !isset($_POST["password"])){
    $error = "Veuillez remplir tous les champs";
    goto display;
}

$request = $db->prepare("SELECT * FROM user WHERE login= :login");
$request->execute([
    'login' => $_POST["login"]
]);
$user = $request->fetch();


if($user === null){
    goto display;
}

$ok = password_verify($_POST["password"], $user["password"]);

if(!$ok){
    $error = "Login ou mot de passe invalide";
    goto display;
}

$_SESSION["user"] = $user;
header("Location: /home");
exit;


display :

?>

<title>Log in</title>
<p> 
<?php 
    if(isset($error)){
        echo $error;
    }
?> 
</p>
<form action="/login" method="POST">
    <label for="login">Enter your login</label>
    <input type="text" name="login">
    <label for="password">Enter your password</label>
    <input type="password" name="password">
    <input type="submit">
</form>
<?php
    include("footer.php");
?>