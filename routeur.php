<?php
$routes = require("routes.php");

$path = explode("?", basename($_SERVER['REQUEST_URI']));

if(!isset($routes[$path[0]])){
    include($routes[""]);
}else{
    include($routes[$path[0]]);
}

