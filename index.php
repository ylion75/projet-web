 
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
    <p>User : <?= $_SESSION["user"]["login"] ?></p>
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

        <?php 
        $likes = $db->prepare("SELECT like_id FROM likes WHERE post_id= ? ");
        $likes ->execute(array($post["id"]));
        $likes =  $likes -> rowCount();
        $dislike = $db->prepare("SELECT dislike_id FROM dislikes WHERE post_id= ?");
        $dislike ->execute(array($post["id"]));
        $dislike =  $dislike -> rowCount();
        ?>

        <a href="likes_dislikes.php?t=2&id=<?=$post["id"] ?>"> Like </a> ( <?=$likes?> )
        <br />
        <a href="likes_dislikes.php?t=3&id=<?=$post["id"] ?>"> Dislike </a> (<?=$dislike?>)
        
        <?php if(isset($_SESSION["userid"]) && $post["author"] === $_SESSION["userid"]){ ?> 
        <a href="deletePost.php?postid=<?= $post["id"] ?>">Delete</a>
        <?php} ?>
        </div>

        <form action="add_comment.php?post_id=<?= $post["id"] ?>" method="POST">
         <label for="comment">Enter your message</label>
         <input type="text" name="comment" id="comment">
         <input type="submit">
         </form>
        
    <?php } ?>

    <?php $request = $db->query("SELECT c.*, u.login FROM user u, comment c, post p WHERE u.id=c.author AND p.id=c.parent_id  ORDER BY c.date, p.author"); ?>
        

  
         <p>***List of comments***<p>
        
         <?php foreach($request as $comment){ ?>
         <div>
         <?php if(isset($_SESSION["userid"]) && $post["id"]===$comment["parent_id"]){?>
         <p> Content : <?= $comment["content"] ?></p>
         <p> Author : <?= $comment["login"] ?></p>
         <p> Date : <?= $comment["date"] ?></p><br> 
 
 
         
         <?php } ?>
         </div>
    <?php } ?>

    </body>
    </html>
<?php } ?>