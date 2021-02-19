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

//$request = $db ->prepare();

$request = $db->prepare("SELECT COUNT(id) FROM user WHERE login= :login");
$request->execute(["login" => $_POST["login"]]);
$existinguser = $request->fetch();

if($existinguser[0] > 0){
    $error = "Ce login existe déjà";
    goto display;
}

$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
$request = $db->prepare("INSERT INTO user (login, password,email) VALUES (?,?,?)");
$request->execute([$_POST["login"], $password, $_POST["email"]]);
//rowCount pour vérifier que tout s'est bien passé
header("Location: index.php");

display :

?>

<!DOCTYPE html>
<html>
<head>RedditBis</head>
<body>
<title>Sign up</title>
<h1>Create a new account</h1>
<?php if(isset($error)) echo $error ?>
    <form action="signup.php" method="POST">
        <label for="login">Enter a login</label>
        <input type="text" name="login">
        <label for="password">Enter a password</label>
        <input type="password" name="password">
        <label for="email">Enter your email adress</label>
        <input required type="email" name="email">
        <input type="submit">

    </form>
    </body>
</html>