<?php
session_start();
include("db_connect.php");
//$error = "";
if($_SERVER['REQUEST_METHOD'] !== "POST"){
    goto display;
}

if(!isset($_POST["login"]) || !isset($_POST["password"])){
    $error = "Veuillez remplir tous les champs";
    goto display;
}

$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
$request = $db->prepare("SELECT * FROM user WHERE login= :login");
$request->execute([
    'login' => $_POST["login"]
]);
$user = $request->fetch();
var_dump($user);
if($user === null){
    goto display;
}

$ok = password_verify($_POST["password"], $user["password"]);

if(!$ok){
    $error = "Login ou mot de passe invalide";
    goto display;
}

$_SESSION["user"] = $user;
header("Location: index.php");
exit;


display :

?>

<!DOCTYPE html>
<html>
<head>RedditBis</head>
<body>
<title>Log in</title>
    <form action="login.php" method="POST">
        <label for="login">Enter your login</label>
        <input type="text" name="login">
        <label for="password">Enter your password</label>
        <input type="password" name="password">
        <input type="submit">
    </form>
    </body>
</html>