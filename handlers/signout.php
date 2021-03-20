<?php
$_SESSION = array();
session_destroy();
header("Location: ".uri("/home?message=Vous avez bien été déconnecté"));
exit;