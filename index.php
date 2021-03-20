<?php
session_start();
require("config.php");
require("db_connect.php");

function uri($path){
    global $config;
    return $config["uri_prefix"].$path;
}

function render($view){
    ob_start();
    require("views/$view.php");
    $content = ob_get_contents();
    ob_end_clean();
    require("views/layout.php");
}

$requestURI = $_SERVER["REQUEST_URI"];
$requestURI = substr($requestURI, strlen($config["uri_prefix"]));
$handler = $config["routes"][$requestURI];

//$path = explode("?", basename($_SERVER['REQUEST_URI']));

//if(!isset($config["routes"][$path[0]])){
if(!isset($handler)){
    require("handlers/".$config["routes"][""].".php");
}else{
    require("handlers/".$config["routes"][$path[0]].".php");
}
