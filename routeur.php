<?php
$routes = require("routes.php");
//$uri = explode('/', $_SERVER['REQUEST_URI']);
//var_dump($uri);
//$path = explode('?', $uri[2]);
//var_dump($path[0]);
$path = explode("?", basename($_SERVER['REQUEST_URI']));
//var_dump($path);
if(!isset($routes[$path[0]])){
    include($routes["/home"]);
}else{
    include($routes[$path[0]]);
}

