<?php
$routes = require("routes.php");
$uri = explode('?', $_SERVER['REQUEST_URI']);
var_dump($_SERVER['REQUEST_URI']);

if(!isset($routes[$uri[0]])){
    include($routes["/login"]);
}else{
    include($routes[$uri[0]]);
}
