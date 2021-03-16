<?php
require("header.php");

$error = $_GET["error"];
?>
<h1>Page not found</h1>
<p>
<?php
    if(isset($error)){
        echo $error;
    }else{
        echo "erreur page inconnue";
    }
?>
</p>

<?php
    require("footer.php");