<h1>Page not found</h1>
<p>
<?php
    if(!isset($_GET["error"])){
        echo "erreur page inconnue";
    }else{
        echo $_GET["error"];
    }
?>
</p>
