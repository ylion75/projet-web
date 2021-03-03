<?php
session_start();
include("db_connect.php");



if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST["login"]) && isset($_POST["password"])){
        $request = $db->query("SELECT * FROM user WHERE login='{$_POST["login"]}' AND password='{$_POST["password"]}'");
        $user = $request->fetch();
        if($user == false){
            $error = "Login ou mot de passe invalide";
        }else{
            $_SESSION["login"] = $user["login"];
            $_SESSION["userid"] = $user["id"];
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>RedditBis</head>
<body>
<?php
if(!isset($_SESSION["user"])){
    ?>
    <title>Sign in</title>
    <form action="login.php" method="POST">
        <label for="login">Enter your login</label>
        <input type="text" name="login" id="login">
        <label for="password">Enter your password</label>
        <input type="password" name="password" id="password">
        <input type="submit">
    </form>
    <?php
}else{ ?>
    <title>Welcome home !</title>
    <form action="signout.php" method="POST">
        <button type="submit">Déconnexion</button>
    </form>
    <p>User : <?= $_SESSION["login"] ?></p>
    <form action="add_post.php" method="POST">
        <label for="title">Choose a title</label>
        <input type="text" name="title" id="title">
        <label for="post">Enter your message</label>
        <input type="text" name="post" id="post">
        <input type="submit">
</form>
<?php } ?>

    
    <?php $request = $db->query("SELECT p.*, u.login FROM user u, post p WHERE u.id=p.author ORDER BY p.date");
    foreach($request as $post){ ?>
    <div> <p> Title : <?= $post["title"] ?> </p>
        <p> Content : <?= $post["content"] ?></p>
        <p> Author : <?= $post["login"] ?></p>
        <p> Date : <?= $post["date"] ?></p><br> 
        <?php if(isset($_SESSION["userid"]) && $post["author"] === $_SESSION["userid"]){ ?> 
        <a href="deletePost.php?postid=<?= $post["id"] ?>">Delete</a>
        <?php } ?>
        </div>
    <?php } ?>
    
    
</body>
</html>
