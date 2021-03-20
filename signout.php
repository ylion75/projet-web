<?php
session_start();
include("redirect.php");
$_SESSION = array();
session_destroy();
header("Location: ".redirect("/home"));
