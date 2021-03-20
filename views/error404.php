<?php
if(!isset($_GET["error"])){
    $error = "";
}else{
    $error = $_GET["error"];
}

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
