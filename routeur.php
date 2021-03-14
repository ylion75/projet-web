<?php
/*
session_start();
require("db_connect.php");

include("header.php");

$routes = require("routes.php");

$uri = explode("/", $_SERVER['REQUEST_URI']);
if(!isset($routes[$uri[1]])){
    include($routes["/home"]);
}
include("\\projet-web-Dev\\".$routes[$uri[1]]);

include("footer.php");
*/