<?php
session_start();
require("config.php");
require("db_connect.php");

function uri($path){
    global $config;
    return $config["uri_prefix"].$path;
}

function render($view, $data){
    extract($data);
    ob_start();
    require("views/$view.php");
    $content = ob_get_contents();
    ob_end_clean();
    require("views/layout.php");
}

$requestURI = explode("?", $_SERVER["REQUEST_URI"]);
$requestURI = substr($requestURI[0], strlen($config["uri_prefix"]));
$handler = $config["routes"][$requestURI];

if(!isset($handler)){
    $handler = $config["routes"]["page_not_found"];
}

require("handlers/$handler.php");
