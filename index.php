<?php

session_start();
include("db_connect.php");

if($_SERVER['REQUEST_METHOD'] === "POST") {
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
    <head>
        <title>RedditBis</title>
    </head>
    <body>
        <?php if(!isset($_SESSION["user"])) { ?>
            <h1>Sign in</h1>
            <form action="login.php" method="POST">
                <label for="login">Enter your login</label>
                <input type="text" name="login" id="login">
                <label for="password">Enter your password</label>
                <input type="password" name="password" id="password">
                <input type="submit">
            </form>
        <?php } else { ?>
            <h1>Welcome home !</h1>
            <form action="signout.php" method="POST">
                <button type="submit">Déconnexion</button>
            </form>
            <p>User: <?= $_SESSION["user"]["login"] ?></p>
            <form action="add_post.php" method="POST">
                <label for="title">Choose a title</label>
                <input type="text" name="title" id="title">
                <label for="post">Enter your message</label>
                <input type="text" name="post" id="post">
                <input type="submit">
            </form>
        <?php } ?>

        <?php
            $request = $db->query("SELECT p.*, u.login FROM user u, post p WHERE u.id=p.author ORDER BY p.date");
            foreach($request as $post) {
                $likes = $db->prepare("SELECT like_id FROM likes WHERE post_id= ? ");
                $likes->execute(array($post["id"]));
                $likes =  $likes->rowCount();
                $dislike = $db->prepare("SELECT dislike_id FROM dislikes WHERE post_id= ?");
                $dislike->execute(array($post["id"]));
                $dislike =  $dislike->rowCount();

                $comments = $request = $db->query("
                    SELECT c.*, u.login
                    FROM user u
                    LEFT JOIN comment c ON c.author = u.id
                    LEFT JOIN post p ON p.id = c.parent_id
                    WHERE p.id = {$post["id"]}
                    ORDER BY c.date, p.author
                ")->fetchAll();
        ?>
            <div>
                <dl>
                    <dt>Title</dt>
                        <dd><?= $post["title"] ?></dd>
                    <dt>Content</dt>
                        <dd><?= $post["content"] ?></dd>
                    <dt>Author</dt>
                        <dd><?= $post["login"] ?></dd>
                    <dt>Date</dt>
                        <dd><?= $post["date"] ?></dd>
                    <dt><a href="likes_dislikes.php?t=2&id=<?= $post["id"] ?>">Like</a></dt>
                        <dd>(<?= $likes ?>)</dd>
                    <dt><a href="likes_dislikes.php?t=3&id=<?= $post["id"] ?>">Dislike</a></dt>
                        <dd>(<?= $likes ?>)</dd>
                    <?php
                        if(isset($_SESSION["user"]) && $post["author"] === $_SESSION["user"]) {
                    ?>
                    <dt><a href="deletePost.php?postid=<?= $post["id"] ?>">Delete</a></dt>
                        <dd></dd>
                    <?php
                        }
                    ?>
                </dt>
                <form action="add_comment.php?post_id=<?= $post["id"] ?>" method="POST">
                     <label for="comment">Enter your message</label>
                     <input type="text" name="comment" id="comment">
                     <input type="submit">
                </form>
                <h2>List of comments</h2>
                <?php
                    foreach($comments as $comment) {
                ?>
                <div>
                    <p> Content : <?= $comment["content"] ?></p>
                    <p> Author : <?= $comment["login"] ?></p>
                    <p> Date : <?= $comment["date"] ?></p>
                </div>
            <?php
                }
            ?>
    </body>
</html>
<?php
                }
            ?>