<h1><?= $forum["nomForum"] ?></h1>
<div>
    <dl>
        <dt>Description</dt><dd><?= $forum["description"] ?></dd>
        <dt>Admin</dt><dd><?= $forum["login"] ?></dd>
        <dt>Categorie</dt><dd><?= $forum["category_name"] ?></dd>
        <dt>Date de creation</dt><dd><?= $forum["dateCreation"] ?></dd>
    </dl>
</div>
<?php 
    if(isset($_SESSION["user"])){
?>
<h2>Add a post :</h2>
<form action="<?= uri("/add_post?forum_id={$forum["idForum"]}") ?>" method="POST">
    <label for="title">Choose a title</label>
    <input type="text" name="title" id="title">
    <label for="post">Enter your message</label>
    <input type="text" name="post" id="post">
    <input type="submit">
</form>
<?php
    }
?>
<h2>Posts</h2>

<?php 
    foreach($posts as $post){
?>
<div>
    <dl>
        <dt>Title</dt><dd><a href="<?= uri("/post?post_id={$post["id"]}")  ?>"><?= $post["title"] ?></a></dd>
        <dt>Author</dt><dd><?= $post["login"] ?></dd>
        <dt>Date de Creation</dt><dd><?= $post["date"] ?></dd>
        <?php 
            if(isset($_SESSION["user"]) && $_SESSION["user"]["id"] === $post["user_id"]){
        ?>
        <dt><a href="<?= uri("/delete_post?post_id={$post["id"]}") ?>">Delete</a></dt><dd></dd>
        <?php
            }
        ?>
    </dl>
</div>
<?php
    }
?>